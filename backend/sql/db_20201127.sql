/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     27/11/2020 18:37:07                          */
/*==============================================================*/


drop table if exists ARTIKLI;

drop table if exists IZBRANI_ARTIKLI;

drop table if exists KRAJ;

drop table if exists NAKUP;

drop table if exists NASLOV;

drop table if exists STATUSNAKUPA;

drop table if exists STRANKA;

drop table if exists ZAPOSLENI;

/*==============================================================*/
/* Table: ARTIKLI                                               */
/*==============================================================*/
create table ARTIKLI
(
   ID_ARTIKEL           int not null auto_increment,
   CENA                 decimal not null,
   OPIS                 text not null,
   NAZIV_ARTIKEL        varchar(60) not null,
   primary key (ID_ARTIKEL)
);

/*==============================================================*/
/* Table: IZBRANI_ARTIKLI                                       */
/*==============================================================*/
create table IZBRANI_ARTIKLI
(
   ID_ARTIKEL           int not null,
   IDNAKUPA             int not null,
   KOLICINA             int,
   primary key (ID_ARTIKEL, IDNAKUPA)
);

/*==============================================================*/
/* Table: KRAJ                                                  */
/*==============================================================*/
create table KRAJ
(
   POSTNA_STEVILKA      int not null,
   KRAJ                 varchar(50) not null,
   primary key (POSTNA_STEVILKA)
);

/*==============================================================*/
/* Table: NAKUP                                                 */
/*==============================================================*/
create table NAKUP
(
   IDNAKUPA             int not null auto_increment,
   ID_STATUS            int not null,
   ID_STRANKA           int not null,
   SKUPNA_CENA          int not null,
   DATUMCAS_NAROCILA    datetime not null,
   DATUMCAS_POTRDILA    datetime not null,
   primary key (IDNAKUPA)
);

/*==============================================================*/
/* Table: NASLOV                                                */
/*==============================================================*/
create table NASLOV
(
   ID_NASLOV            int not null auto_increment,
   POSTNA_STEVILKA      int not null,
   ULICA                varchar(50) not null,
   HISNA_STEVILKA       varchar(5) not null,
   primary key (ID_NASLOV)
);

/*==============================================================*/
/* Table: STATUSNAKUPA                                          */
/*==============================================================*/
create table STATUSNAKUPA
(
   ID_STATUS            int not null auto_increment,
   NAZIV_STATUS         varchar(10) not null,
   primary key (ID_STATUS)
);

/*==============================================================*/
/* Table: STRANKA                                               */
/*==============================================================*/
create table STRANKA
(
   ID_STRANKA           int not null auto_increment,
   ID_NASLOV            int,
   IME                  varchar(25) not null,
   PRIIMEK              varchar(25) not null,
   EMAIL                varchar(50),
   GESLO                varchar(100),
   DATUMREGISTRACIJE    date not null,
   primary key (ID_STRANKA)
);

/*==============================================================*/
/* Table: ZAPOSLENI                                             */
/*==============================================================*/
create table ZAPOSLENI
(
   ID_ZAPOSLENI         int not null auto_increment,
   IME                  varchar(25) not null,
   PRIIMEK              varchar(25) not null,
   EMAIL                varchar(50),
   GESLO                varchar(100),
   ADMIN                bool,
   IZBRISAN             bool,
   primary key (ID_ZAPOSLENI)
);

alter table IZBRANI_ARTIKLI add constraint FK_IZBRANI_ARTIKLI foreign key (ID_ARTIKEL)
      references ARTIKLI (ID_ARTIKEL) on delete restrict on update restrict;

alter table IZBRANI_ARTIKLI add constraint FK_IZBRANI_ARTIKLI2 foreign key (IDNAKUPA)
      references NAKUP (IDNAKUPA) on delete restrict on update restrict;

alter table NAKUP add constraint FK_IMA foreign key (ID_STATUS)
      references STATUSNAKUPA (ID_STATUS) on delete restrict on update restrict;

alter table NAKUP add constraint FK_IZVEDE foreign key (ID_STRANKA)
      references STRANKA (ID_STRANKA) on delete restrict on update restrict;

alter table NASLOV add constraint FK_LEZI_V foreign key (POSTNA_STEVILKA)
      references KRAJ (POSTNA_STEVILKA) on delete restrict on update restrict;

alter table STRANKA add constraint FK_SE_NAHAJA foreign key (ID_NASLOV)
      references NASLOV (ID_NASLOV) on delete restrict on update restrict;

sartikliartikliartiklieminarska_naloga_ep2020