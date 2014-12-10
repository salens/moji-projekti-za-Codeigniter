DROP DATABASE IF EXISTS vodic;

CREATE DATABASE vodic;

USE vodic;

CREATE TABLE korisnik
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	ime VARCHAR (25) NOT NULL,
	prezime VARCHAR (25) NOT NULL,
	email VARCHAR (50) NOT NULL,
	lozinka VARCHAR (20) NOT NULL,
	fotografija VARCHAR(50) DEFAULT NULL, 
	adresa VARCHAR (50) DEFAULT NULL,
	grad VARCHAR (80) DEFAULT NULL,
	drzava VARCHAR(50) DEFAULT NULL,
	telefon VARCHAR(30) DEFAULT NULL,
	linkedin VARCHAR (50) DEFAULT NULL,
	google VARCHAR (50) DEFAULT NULL,
	facebook VARCHAR (50) DEFAULT NULL,
	twiter VARCHAR (50) DEFAULT NULL,
	tip TINYINT UNSIGNED DEFAULT 0,
	UNIQUE KEY(email), 
	PRIMARY KEY(id)	

)ENGINE = InnoDB DEFAULT CHARSET = utf8;



CREATE TABLE lokacija
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	naziv VARCHAR(45) NOT NULL,
	opis VARCHAR(500) DEFAULT NULL,
	adresa VARCHAR(50) DEFAULT NULL,
	grad VARCHAR(80) DEFAULT NULL,
	email VARCHAR(50) DEFAULT NULL,
	web VARCHAR(50) DEFAULT NULL,
	telefon VARCHAR(30) DEFAULT NULL,
	PRIMARY KEY(id)
	
)ENGINE = InnoDB DEFAULT CHARSET = utf8;



CREATE TABLE grupa (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idNadgrupa INT UNSIGNED DEFAULT NULL,
	naziv VARCHAR(50) NOT NULL,
	FOREIGN KEY (idNadgrupa) REFERENCES grupa (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
	UNIQUE KEY (naziv),
	PRIMARY KEY (id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8;



CREATE TABLE desavanje
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idKorisnik INT UNSIGNED NOT NULL,
	idGrupa INT UNSIGNED NOT NULL,
	tekst text(800) NOT NULL,
	naslov tinytext NOT NULL,
	FOREIGN KEY (idKorisnik) REFERENCES korisnik (id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (idGrupa) REFERENCES grupa (id) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY (id)

)ENGINE = InnoDB DEFAULT CHARSET = utf8;



CREATE TABLE ocenjuje
(	
	idKorisnik INT UNSIGNED NOT NULL,
	idDesavanje INT UNSIGNED NOT NULL,
	ocena TINYINT UNSIGNED NOT NULL,
	FOREIGN KEY (idKorisnik) REFERENCES korisnik (id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (idDesavanje) REFERENCES desavanje (id) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY (idKorisnik, idDesavanje)	

)ENGINE = InnoDB DEFAULT CHARSET = utf8;



CREATE TABLE tag
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	naziv VARCHAR(70) NOT NULL,
	PRIMARY KEY(id)
	
)ENGINE = InnoDB DEFAULT CHARSET = utf8;



CREATE TABLE pridruzuje
(
	idDesavanje INT UNSIGNED NOT NULL,
	idTag INT UNSIGNED NOT NULL,
	FOREIGN KEY (idDesavanje) REFERENCES desavanje (id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (idTag) REFERENCES tag (id) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY (idDesavanje , idTag)
	


)ENGINE = InnoDB DEFAULT CHARSET = utf8;



CREATE TABLE izbor
(	
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idDesavanje INT UNSIGNED NOT NULL,
	idLokacija INT UNSIGNED NOT NULL,
	cenaUlaznice DECIMAL UNSIGNED NOT NULL,
	datum DATETIME NOT NULL,
	brKarata SMALLINT DEFAULT NULL,
	FOREIGN KEY (idDesavanje) REFERENCES desavanje (id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (idLokacija) REFERENCES lokacija (id) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY (id)
	
)ENGINE = InnoDB DEFAULT CHARSET = utf8;



CREATE TABLE komentar
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idKorisnik INT UNSIGNED NOT NULL,
	idDesavanje INT UNSIGNED NOT NULL,
	tekst text(800) NOT NULL,
	FOREIGN KEY (idKorisnik) REFERENCES korisnik (id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (idDesavanje) REFERENCES desavanje (id) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY (id)

)ENGINE = InnoDB DEFAULT CHARSET = utf8;



CREATE TABLE RezervacijaKarata
(	
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idKorisnik INT UNSIGNED NOT NULL,
	vreme TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	FOREIGN KEY (idKorisnik) REFERENCES korisnik (id) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY (id)	

)ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE Rezervise
(
	idIzbor INT UNSIGNED NOT NULL,
	idRezKarata INT UNSIGNED NOT NULL,
	kolicina INT DEFAULT NULL,
	FOREIGN KEY (idIzbor) REFERENCES izbor (id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (idRezKarata) REFERENCES RezervacijaKarata (id) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY (idIzbor , idRezKarata)
	


)ENGINE = InnoDB DEFAULT CHARSET = utf8;



INSERT INTO korisnik(tip,ime,prezime,email,lozinka) VALUES
(1,"Stanislav","Sencanski","salens82@hotmail.com","sasans82"),
(1,"Filip","Dundjer","filip@hotmail.com","filip92"),
(1,"Filip","Vajgand","vajgand92@hotmail.com","vajgi92"),
(1,"Djuro","Matic","djuro92@hotmail.com","djura92");

INSERT INTO lokacija(naziv,opis,adresa,grad,email,web,telefon) VALUES
("Srpsko narodno pozoriste","Pozoriste","zmaj jovina 10","Novi Sad","snp@hotmail.com","www.snp-novisad.rs", "011/3821110"),
("Cinaplex-NS","Bioskop","Zmaj Jovina br. 34","Novi Sad","cinaplex@hotmail.com","www.cinaplex-novisad.rs", "021/324524"),
("Verige","Club","kisacka 40","Novi Sad","verige@hotmail.com","www.verige-novisad.rs", "021/650425"),
("Djava","Diskoteka","Petrovaradinska tvrdjava","Novi Sad","djava@hotmail.com","www.djava.rs", "021/500345"),
("Cinaplex-BG","Bioskop","Centar br. 5","Beograd","cinaplex@hotmail.com","www.cinaplex-bg.rs", "011/324524");
	
INSERT INTO grupa(naziv) VALUES
	("Pozoriste"),
	("Bioskop"),
	("Club"),
	("Diskoteka");
	
INSERT INTO grupa(idNadgrupa, naziv) VALUES
	(1, "Komedija"),
	(1, "Drama"),
	(2, "FilmskaKomedija"),
	(2, "FilmskaDrama"),
	(3, "Domaca Muzika"),
	(4, "House muzika");
	
	
INSERT INTO desavanje(idKorisnik,idGrupa,tekst,naslov) VALUES
	(1, 5,"Predstava 1","Lud Zbunjen"),
	(2, 7,"Film","Mrtav Ladan"),
	(3, 9,"Club","Luna Band"),
	(4, 10,"Diskoteka","Striptease"),
	(4, 7,"Movie","Hangover part II");
	

	
INSERT INTO komentar(idKorisnik, idDesavanje, tekst) VALUES
(1, 1, "Jako dobra predstava!"),
(1, 2, "Extra Film!"),
(2, 4, "Stvarno je bilo vrh.."),
(3, 3, "Ali stvarno bez tekstA..."),
(3, 3, "opalaaaa ludiloo.."),
(4, 4, "Najbolji provod do sada! :)"),
(2, 2, "superiska movie!");


INSERT INTO tag(naziv) VALUES
("Vece pozorista"),
("Filmanija"),
("Ziva Svirka"),
("Striptease Night");

INSERT INTO pridruzuje(idDesavanje, idTag) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 2);


INSERT INTO ocenjuje(idKorisnik, idDesavanje, ocena) VALUES
(1, 1,4),
(1, 2,5),
(2, 4,5),
(3, 3,4),
(3, 4,3),
(4, 4,5),
(2, 2,3);



INSERT INTO izbor(idDesavanje, idLokacija, datum, brKarata, cenaUlaznice) VALUES
(1, 1,"2013-05-05 22:00",300,500),
(2, 2,"2013-04-08 20:00",250,450),
(3, 3,"2013-05-08 22:30",150,200),
(4, 4,"2013-04-08 23:30",200,250),
(5, 5,"2013-04-08 21:30",250,450);


INSERT INTO RezervacijaKarata(idKorisnik, vreme) VALUES
(1,"2013-04-05 19:30"),
(1,"2013-03-05 15:00"),
(3,"2013-04-05 23:15"),
(4,"2013-03-05 21:00"),
(4,"2013-03-05 18:00"),
(2,"2013-03-05 00:10");


INSERT INTO Rezervise(idIzbor, idRezKarata,kolicina) VALUES
(1, 1,50),
(2, 2,25),
(3, 3,5),
(4, 4,2),
(5, 5,3);