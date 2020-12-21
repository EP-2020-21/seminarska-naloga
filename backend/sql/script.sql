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


create table KATEGORIJE
(
    ID_KATEGORIJE int unsigned auto_increment
        primary key,
    NAZIV_KATEGORIJE varchar(50) null
)
    comment 'Kategorije ponudbe';

create table KRAJ
(
    POSTNA_STEVILKA int not null
        primary key,
    KRAJ varchar(50) not null
);

create table NASLOV
(
    ID_NASLOV int auto_increment
        primary key,
    POSTNA_STEVILKA int not null,
    ULICA varchar(50) not null,
    HISNA_STEVILKA varchar(5) not null,
    constraint FK_LEZI_V
        foreign key (POSTNA_STEVILKA) references KRAJ (POSTNA_STEVILKA)
);

create table PONUDBA
(
    ID_ARTIKEL int auto_increment
        primary key,
    PATH_TO_IMG varchar(300) default '0' not null,
    CENA float default 0 not null,
    OPIS text not null,
    KATEGORIJA int unsigned not null,
    NAZIV_ARTIKEL varchar(60) not null,
    IZBRISAN tinyint default 0 not null,
    constraint FK_ponudba_kategorije
        foreign key (KATEGORIJA) references KATEGORIJE (ID_KATEGORIJE)
);

create table STATUSNAKUPA
(
    ID_STATUS int auto_increment
        primary key,
    NAZIV_STATUS varchar(10) not null
);

create table STRANKA
(
    ID_STRANKA int auto_increment
        primary key,
    ID_NASLOV int null,
    IME varchar(25) not null,
    PRIIMEK varchar(25) not null,
    EMAIL varchar(50) null,
    GESLO varchar(100) null,
    DATUMREGISTRACIJE timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    IZBRISAN tinyint default 0 null,
    constraint FK_SE_NAHAJA
        foreign key (ID_NASLOV) references NASLOV (ID_NASLOV)
);

create table NAKUP
(
    IDNAKUPA int auto_increment
        primary key,
    ID_STATUS int not null,
    ID_STRANKA int not null,
    SKUPNA_CENA float not null,
    DATUMCAS_NAROCILA datetime default CURRENT_TIMESTAMP not null,
    DATUMCAS_POTRDILA datetime null,
    constraint FK_IMA
        foreign key (ID_STATUS) references STATUSNAKUPA (ID_STATUS),
    constraint FK_IZVEDE
        foreign key (ID_STRANKA) references STRANKA (ID_STRANKA)
);

create table IZBRANI_ARTIKLI
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

create table ZAPOSLENI
(
    ID_ZAPOSLENI int auto_increment
        primary key,
    IME varchar(25) not null,
    PRIIMEK varchar(25) not null,
    EMAIL varchar(50) null,
    GESLO varchar(100) null,
    ADMIN tinyint(1) null,
    IZBRISAN tinyint(1) null,
    CERT varchar(50) not null
);


insert into seminarska_naloga_ep2020.KATEGORIJE (ID_KATEGORIJE, NAZIV_KATEGORIJE)
values  (1, 'Burgerji'),
        (2, 'Pijača'),
        (3, 'Priloge'),
        (4, 'Steak'),
        (5, 'Vedno paše');

insert into seminarska_naloga_ep2020.PONUDBA (ID_ARTIKEL, PATH_TO_IMG, CENA, OPIS, KATEGORIJA, NAZIV_ARTIKEL, IZBRISAN)
values  (1, 'https://res.cloudinary.com/karantenafud/image/upload/v1608462959/fud/domaci-burger_el89ma.jpg', 5.99, ' Krompirjeva bombica popečena na maslu, 100% govedina slovenskega porekla, naša classic hišna omaka, sveža domača solata, rezine sladkega paradižnika in Cheddar sir.', 1, 'Burger domači', 0),
        (2, 'https://res.cloudinary.com/karantenafud/image/upload/v1608462960/fud/pommes_lce29j.jpg', 3.99, 'Vsak dan sveže olupljen in narezan slovenski krompirček. Ocvrt v 100% arašidovem olju. Prava družba za tvoj najljubši burger.', 3, 'Pomfri krompirček', 0),
        (3, 'https://res.cloudinary.com/karantenafud/image/upload/v1608462959/fud/buffalo-wings_ei3cir.jpg', 6.99, 'Ljubitelji piščančjih perutničk poznajo užitek hrustljave začinjene kože, ki je bistvo te jedi.', 5, 'Buffalo perutničke', 0),
        (4, 'https://res.cloudinary.com/karantenafud/image/upload/v1608464893/fud/Mexican-Style-Hot-Dogs-picture-11-720x405_ft9z3f.jpg', 4.99, 'Juicy..tasty...with a good smell and lovely caramelized onion..🤟', 1, 'the Hot Dog', 0),
        (5, 'https://res.cloudinary.com/karantenafud/image/upload/v1608462962/fud/lemon-juice_fcy6rs.png', 2.5, 'Narejeno iz domačega limoninega sirupa.', 2, 'Limonada', 0),
        (7, 'https://res.cloudinary.com/karantenafud/image/upload/v1608462964/fud/coca-cola_gmt2uu.png', 2.5, 'Paše kot ata na mamo.', 2, 'Coca-cola', 0),
        (8, 'https://res.cloudinary.com/karantenafud/image/upload/v1608462963/fud/pizza_tfngbq.png', 7.99, 'Pizze iz fermentiranega testa z drožmi, vzhajanega 48 ur, pečene eno minuto na 450°C', 5, 'Pizza', 0),
        (9, 'https://res.cloudinary.com/karantenafud/image/upload/v1608462960/fud/piscancji-burger_lpjgff.jpg', 6.99, 'Piščančji file, paniran in ocvrt v panadi moke in jajčk, zeliščna ranch omaka, kisle kumarice, listnata solata in paradižnik. Postreženo v klasični krompirjevi bombeti.', 1, 'Burger Crispy Chicken', 0),
        (10, 'https://res.cloudinary.com/karantenafud/image/upload/v1608462959/fud/philly-steak_zewchb.jpg', 8.99, 'Rezine 100% slovenske govedine, brez GSO, jalapeno paprika, karamelizirana čebulica in angleški cheddar sir. Zavito v domačo oljno štručko.', 4, 'Philly steak', 0),
        (11, 'https://res.cloudinary.com/karantenafud/image/upload/v1608462960/fud/roastbeef-steak_l1lhrs.jpg', 11.99, '100% black angus roastbeef govedina brez GSO, karamelizirana čebulica in originalni italijanski provolone sir. Zavito v domačo oljno štručko.', 4, 'Angus roastbeef steak', 0),
        (12, 'https://res.cloudinary.com/karantenafud/image/upload/v1608461926/fud/jeesyaltgmyizdzws3o6.jpg', 6.99, 'Dobra klasika cheddar sir in angus beef pleskavica', 1, 'Cheeseburger', 0);

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

insert into seminarska_naloga_ep2020.STATUSNAKUPA (ID_STATUS, NAZIV_STATUS)
values  (1, 'Plačano'),
        (2, 'Potrjeno'),
        (3, 'Stornirano'),
        (4, 'Preklicano');

insert into seminarska_naloga_ep2020.NAKUP (IDNAKUPA, ID_STATUS, ID_STRANKA, SKUPNA_CENA, DATUMCAS_NAROCILA, DATUMCAS_POTRDILA)
values  (3, 2, 2, 40, '2020-12-20 22:39:11', null),
        (4, 1, 2, 39.95, '2020-12-20 22:42:42', null);

insert into seminarska_naloga_ep2020.IZBRANI_ARTIKLI (ID_ARTIKEL, IDNAKUPA, KOLICINA)
values  (1, 3, 1),
        (1, 4, 1),
        (9, 3, 1),
        (9, 4, 1),
        (10, 3, 3),
        (10, 4, 3);
