DROP DATABASE IF EXISTS `seminarska_naloga_ep2020`;
CREATE DATABASE IF NOT EXISTS `seminarska_naloga_ep2020` /*!40100 DEFAULT CHARACTER SET utf16 COLLATE utf16_slovenian_ci */;
USE `seminarska_naloga_ep2020`;

# drop table IZBRANI_ARTIKLI;
# drop table KATEGORIJE;
# drop table KRAJ;
# drop table NASLOV;
# drop table PONUDBA;
# drop table STATUSNAKUPA;
# drop table STRANKA;
# drop table ZAPOSLENI;


create table if not exists KATEGORIJE
(
    ID_KATEGORIJE int unsigned auto_increment
        primary key,
    NAZIV_KATEGORIJE varchar(50) null
)
    comment 'Kategorije ponudbe';

create table if not exists KRAJ
(
    POSTNA_STEVILKA int not null
        primary key,
    KRAJ varchar(50) not null
);

create table if not exists NASLOV
(
    ID_NASLOV int auto_increment
        primary key,
    POSTNA_STEVILKA int not null,
    ULICA varchar(50) not null,
    HISNA_STEVILKA varchar(5) not null,
    constraint FK_LEZI_V
        foreign key (POSTNA_STEVILKA) references KRAJ (POSTNA_STEVILKA)
);

create table if not exists PONUDBA
(
    ID_ARTIKEL int auto_increment
        primary key,
    PATH_TO_IMG varchar(75) default '0' not null,
    CENA float default 0 not null,
    OPIS text not null,
    KATEGORIJA int unsigned not null,
    NAZIV_ARTIKEL varchar(60) not null,
    constraint FK_ponudba_kategorije
        foreign key (KATEGORIJA) references KATEGORIJE (ID_KATEGORIJE)
);

create table if not exists STATUSNAKUPA
(
    ID_STATUS int auto_increment
        primary key,
    NAZIV_STATUS varchar(10) not null
);

create table if not exists STRANKA
(
    ID_STRANKA int auto_increment
        primary key,
    ID_NASLOV int null,
    IME varchar(25) not null,
    PRIIMEK varchar(25) not null,
    EMAIL varchar(50) null,
    GESLO varchar(100) null,
    DATUMREGISTRACIJE timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    constraint FK_SE_NAHAJA
        foreign key (ID_NASLOV) references NASLOV (ID_NASLOV)
);

create table if not exists NAKUP
(
    IDNAKUPA int auto_increment
        primary key,
    ID_STATUS int not null,
    ID_STRANKA int not null,
    SKUPNA_CENA int not null,
    DATUMCAS_NAROCILA datetime not null,
    DATUMCAS_POTRDILA datetime not null,
    constraint FK_IMA
        foreign key (ID_STATUS) references STATUSNAKUPA (ID_STATUS),
    constraint FK_IZVEDE
        foreign key (ID_STRANKA) references STRANKA (ID_STRANKA)
);

create table if not exists IZBRANI_ARTIKLI
(
    ID_ARTIKEL int not null,
    IDNAKUPA int not null,
    KOLICINA int null,
    primary key (ID_ARTIKEL, IDNAKUPA),
    constraint FK_IZBRANI_ARTIKLI
        foreign key (ID_ARTIKEL) references PONUDBA (ID_ARTIKEL),
    constraint FK_IZBRANI_ARTIKLI2
        foreign key (IDNAKUPA) references NAKUP (IDNAKUPA)
);

create table if not exists ZAPOSLENI
(
    ID_ZAPOSLENI int auto_increment
    primary key,
    IME          varchar(25)  not null,
    PRIIMEK      varchar(25)  not null,
    EMAIL        varchar(50)  null,
    GESLO        varchar(100) null,
    ADMIN        tinyint(1)   null,
    IZBRISAN     tinyint(1)   null,
    CERT         varchar(50)  not null
);

insert into seminarska_naloga_ep2020.KATEGORIJE (ID_KATEGORIJE, NAZIV_KATEGORIJE)
values  (1, 'Burgerji'),
        (2, 'Pijača'),
        (3, 'Priloge'),
        (4, 'Steak'),
        (5, 'Vedno paše');

insert into seminarska_naloga_ep2020.PONUDBA (ID_ARTIKEL, PATH_TO_IMG, CENA, OPIS, KATEGORIJA, NAZIV_ARTIKEL)
values  (1, 'frontend\\static\\images\\ponudba\\domaci-burger.jpg', 5.99, ' Krompirjeva bombica popečena na maslu, 100% govedina slovenskega porekla, naša classic hišna omaka, sveža domača solata, rezine sladkega paradižnika in Cheddar sir.', 1, 'Burger domači'),
        (2, 'frontend\\static\\images\\ponudba\\pommes.jpg', 3.99, 'Vsak dan sveže olupljen in narezan slovenski krompirček. Ocvrt v 100% arašidovem olju. Prava družba za tvoj najljubši burger.', 3, 'Pomfri krompirček'),
        (3, 'frontend\\static\\images\\ponudba\\buffalo-wings.jpg', 6.99, 'Ljubitelji piščančjih perutničk poznajo užitek hrustljave začinjene kože, ki je bistvo te jedi.', 5, 'Buffalo perutničke'),
        (4, 'frontend\\static\\images\\ponudba\\hotdog.png', 4.99, 'Juicy..tasty...with a good smell and lovely caramelized onion..🤟', 1, 'the Hot Dog'),
        (5, 'frontend\\static\\images\\ponudba\\lemon-juice.png', 2.5, 'Narejeno iz domačega limoninega sirupa.', 2, 'Limonada'),
        (7, 'frontend\\static\\images\\ponudba\\coca-cola.png', 2.5, 'Paše kot ata na mamo.', 2, 'Coca-cola'),
        (8, 'frontend\\static\\images\\ponudba\\pizza.png', 7.99, 'Pizze iz fermentiranega testa z drožmi, vzhajanega 48 ur, pečene eno minuto na 450°C', 5, 'Pizza'),
        (9, 'frontend\\static\\images\\ponudba\\piscancji-burger.jpg', 6.99, 'Piščančji file, paniran in ocvrt v panadi moke in jajčk, zeliščna ranch omaka, kisle kumarice, listnata solata in paradižnik. Postreženo v klasični krompirjevi bombeti.', 1, 'Burger Crispy Chicken'),
        (10, 'frontend\\static\\images\\ponudba\\philly-steak.jpg', 8.99, 'Rezine 100% slovenske govedine, brez GSO, jalapeno paprika, karamelizirana čebulica in angleški cheddar sir. Zavito v domačo oljno štručko.', 4, 'Philly steak'),
        (11, 'frontend\\static\\images\\ponudba\\roastbeef-steak.jpg', 11.99, '100% black angus roastbeef govedina brez GSO, karamelizirana čebulica in originalni italijanski provolone sir. Zavito v domačo oljno štručko.', 4, 'Angus roastbeef steak');

insert into seminarska_naloga_ep2020.KRAJ (POSTNA_STEVILKA, KRAJ)
values  (1000, 'Ljubljana'),
        (1312, 'Videm-Dobrepolje'),
        (8000, 'Novo Mesto');

insert into seminarska_naloga_ep2020.NASLOV (ID_NASLOV, POSTNA_STEVILKA, ULICA, HISNA_STEVILKA)
values  (1, 1000, 'Predstruge', '21a'),
        (2, 1000, 'Ponikve', '21a'),
        (3, 1000, 'Ulica sv Petra', '12'),
        (4, 8000, 'Gotna vas', '51'),
        (5, 8000, 'Jurna vas', '51');

insert into seminarska_naloga_ep2020.STRANKA (ID_STRANKA, ID_NASLOV, IME, PRIIMEK, EMAIL, GESLO, DATUMREGISTRACIJE)
values  (1, 1, 'Martin', 'Strekelj', 'strekelj123@gmail.com', '219a402c', '2020-11-28 12:25:21'),
        (2, 3, 'Megi', 'Skufca', 'foo@bar.com', '219a402c', '2020-11-28 12:34:03'),
        (5, 5, 'Micka', 'Kovačeva', 'foo12345@bar.com', '219a402c', '2020-11-28 12:40:54'),
        (6, 1, 'Martin', 'Štrekelj', 'martin.strekelj123@gmail.com', '219a402c', '2020-12-01 17:24:22');

insert into seminarska_naloga_ep2020.ZAPOSLENI (ID_ZAPOSLENI, IME, PRIIMEK, EMAIL, GESLO, ADMIN, IZBRISAN, CERT)
values  (1, 'Simon', 'Babnik', 'simon@fud.si', 'simon123', 0, 0, 'Simon'),
        (2, 'Martin', 'Štrekelj', 'martin@fud.si', 'martin123', 1, 0, 'Martin'),
        (3, 'Luka', 'Tomažič', 'luka@fud.si', 'luka123', 0, 0, 'Luka');