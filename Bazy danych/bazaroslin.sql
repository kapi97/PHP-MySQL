create table uzytkownik(
    id_uzytkownika int AUTO_INCREMENT PRIMARY KEY,
    login varchar(50) not null,
    pass varchar(50) not null,   
    admin int(1) not null
);

create table rosliny(
  id_roslina int AUTO_INCREMENT PRIMARY KEY,
  nazwa_rosliny VARCHAR(50) not null
);

create table nawozy(
  id_nawoz int AUTO_INCREMENT PRIMARY KEY,
  nazwa_nawozu VARCHAR(50) not null
);

create table obszary(
  id_obszar int AUTO_INCREMENT PRIMARY KEY,
  pole int not null
);

create table doswiadczenie(
	id_doswiadczenie int AUTO_INCREMENT PRIMARY KEY,
	czy_nawoz int(1) not null,
	id_obszar int not null,
	id_roslina int not null,
	id_nawoz int not null
);

create table wyniki(
	id_wynik int AUTO_INCREMENT PRIMARY KEY,
	ile_roslin int not null,
	srednia_wielkosc int not null,
	id_doswiadczenie int not null,
	data timestamp
);

insert into uzytkownik(login,pass,admin) values ("admin","qwer","1");
insert into uzytkownik(login,pass,admin) values ("user1","user1","0");
insert into uzytkownik(login,pass,admin) values ("user2","user2","0");
insert into uzytkownik(login,pass,admin) values ("user3","user3","0");

insert into rosliny(nazwa_rosliny) VALUES ("kwiat lotosu");
insert into rosliny(nazwa_rosliny) VALUES ("papryczka chili");
insert into rosliny(nazwa_rosliny) VALUES ("cytryna afrykańska");
insert into rosliny(nazwa_rosliny) VALUES ("cytryna muzułmańska");

insert into nawozy(nazwa_nawozu) VALUES ("czerwony");
insert into nawozy(nazwa_nawozu) VALUES ("zielony");
insert into nawozy(nazwa_nawozu) VALUES ("niebieski");


insert into obszary(pole) VALUES (5);
insert into obszary(pole) VALUES (10);
insert into obszary(pole) VALUES (15);
