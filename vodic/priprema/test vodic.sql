/* UPITI*/

/* 1. Svih grupa koje nemaju nadgrupu; */

SELECT naziv
FROM grupa
WHERE idNadgrupa IS NULL;

/* 2. Svih podgrupa određene grupe; */

SELECT naziv
FROM grupa
WHERE idNadgrupa = 2;

/* 3. Svih dešavanja koja pripadaju određenoj grupi, tj. podgrupi; */

SELECT desavanje.naslov AS 'Odigrava se'
FROM desavanje INNER JOIN grupa ON desavanje.id= grupa.id
WHERE grupa.id = 3;

/* 4. Svih lokacija na kojima se odvija određeno dešavanje; */

SELECT lokacija.naziv AS Lokacija,desavanje.tekst AS Desavanje,desavanje.naslov AS 'Naslov Filma'
FROM lokacija INNER JOIN izbor ON lokacija.id=izbor.idLokacija
			  INNER JOIN desavanje ON desavanje.id=izbor.idDesavanje
WHERE desavanje.id = 5;

/* 5. Svih dešavanja koja se odvijaju na određenoj lokaciji određenog datuma; */

SELECT lokacija.naziv AS Lokacija,desavanje.tekst AS Desavanje,desavanje.naslov AS 'Naslov Filma', izbor.vreme
FROM lokacija INNER JOIN izbor ON lokacija.id=izbor.idLokacija
			  INNER JOIN desavanje ON izbor.idDesavanje=desavanje.id
WHERE lokacija.grad = 'Beograd' AND izbor.vreme = '2013-04-08 21:30:00';

/* 6. Svih dešavanja koja je definisao određeni korisnik; */

SELECT lokacija.opis AS 'U',lokacija.naziv AS Lokacija,desavanje.naslov AS 'odigrava se'
FROM lokacija INNER JOIN izbor ON lokacija.id=izbor.idLokacija
			  INNER JOIN desavanje ON izbor.idDesavanje=desavanje.id
WHERE desavanje.idKorisnik = 4;

/* 7. Svih tagova koji su pridruženi određenom dešavanju; */ 

SELECT desavanje.naslov AS Desavanje,tag.naziv AS 'Naziv Tag-a'
FROM desavanje INNER JOIN pridruzuje ON desavanje.id=pridruzuje.idDesavanje
			   INNER JOIN tag ON pridruzuje.idTag=tag.id
WHERE desavanje.id = 2 OR desavanje.id = 3;

/* 8. Svih dešavanja koja su pridružena određenom tagu; */

SELECT tag.naziv AS 'Naziv Tag-a', desavanje.naslov AS Desavanje
FROM desavanje INNER JOIN pridruzuje ON desavanje.id=pridruzuje.idDesavanje
			   INNER JOIN tag ON pridruzuje.idTag=tag.id
WHERE tag.naziv = 'Filmanija';

/* 9. Svih komentara i svih ocena vezanih za određeno dešavanje; */  

SELECT desavanje.naslov AS 'Desavanje',komentar.idKorisnik AS Korisnik,komentar.tekst AS Komentar,ocenjuje.idKorisnik AS Korisnik,ocenjuje.ocena
FROM desavanje
LEFT OUTER JOIN komentar ON desavanje.id = komentar.idDesavanje
LEFT OUTER JOIN ocenjuje ON desavanje.id = ocenjuje.idDesavanje
WHERE desavanje.id = 2;

/* 10. Svih komentara i svih ocena određenog korisnika; */   

SELECT korisnik.id AS Korisnik,komentar.tekst AS Komentar, ocenjuje.ocena
FROM korisnik
LEFT OUTER JOIN komentar ON korisnik.id = komentar.idKorisnik
LEFT OUTER JOIN ocenjuje ON korisnik.id = ocenjuje.idKorisnik
WHERE korisnik.id = 3;

/* 11. Svih dešavanja koja u svom naslovu sadrže određenu reč; */

SELECT *
FROM desavanje		
WHERE naslov LIKE "%Band%";

/* 12. Svih rezervacija određenog korisnika; */    

SELECT RezervacijaKarata.idKorisnik AS Korisnik,rezervise.kolicina AS Kol_Rez_Karata, RezervacijaKarata.vreme AS 'Vreme Rezervisanja', izbor.cenaUlaznice AS 'Cena Karte', desavanje.naslov AS 'Za Desavanje'
FROM RezervacijaKarata
INNER JOIN korisnik ON RezervacijaKarata.idKorisnik = korisnik.id
INNER JOIN rezervise ON RezervacijaKarata.id = rezervise.idRezKarata
INNER JOIN izbor ON rezervise.idIzbor = izbor.id
INNER JOIN desavanje ON izbor.idDesavanje = desavanje.id
WHERE RezervacijaKarata.idKorisnik = 1;

/* 13. Sadržaj određene rezervacije (broj rezervisanih karata za svako dešavanje i podaci o svim
dešavanjima koja pripadaju određenoj rezervaciji); */

SELECT RezervacijaKarata.idKorisnik AS Korisnik,rezervise.kolicina AS Kol_Rez_Karata, RezervacijaKarata.vreme AS 'Vreme Rezervisanja', izbor.cenaUlaznice AS 'Cena Karte', desavanje.naslov AS 'Za Desavanje',
	   lokacija.opis AS 'Odigrava se u',lokacija.naziv AS 'Naziv Mesta',lokacija.adresa,lokacija.grad AS 'U gradu'
FROM RezervacijaKarata
INNER JOIN korisnik ON RezervacijaKarata.idKorisnik = korisnik.id
INNER JOIN rezervise ON RezervacijaKarata.id = rezervise.idRezKarata
INNER JOIN izbor ON rezervise.idIzbor = izbor.id
INNER JOIN desavanje ON izbor.idDesavanje = desavanje.id
INNER JOIN lokacija ON izbor.idLokacija = lokacija.id\G

			   			 

/* 14. Svih korisnika koji su rezervisali barem jednu kartu za određeno dešavanje na određenoj lokaciji; */ 

SELECT RezervacijaKarata.idKorisnik AS Korisnik,rezervise.kolicina AS Kol_Rez_Karata, RezervacijaKarata.vreme AS 'Vreme Rezervisanja', izbor.cenaUlaznice AS 'Cena Karte', desavanje.naslov AS 'Za Desavanje',
	   lokacija.opis AS 'Odigrava se u',lokacija.naziv AS 'Naziv Mesta',lokacija.adresa,lokacija.grad AS 'U gradu'
FROM RezervacijaKarata
INNER JOIN korisnik ON RezervacijaKarata.idKorisnik = korisnik.id
LEFT OUTER JOIN rezervise ON RezervacijaKarata.id = rezervise.idRezKarata
INNER JOIN izbor ON rezervise.idIzbor = izbor.id
INNER JOIN desavanje ON izbor.idDesavanje = desavanje.id
INNER JOIN lokacija ON izbor.idLokacija = lokacija.id
WHERE rezervise.kolicina IS NOT NULL\G


/* 15. Svih dešavanja koja su se odvijala na određenoj lokaciji, za koje je određeni korisnik rezervisao
barem jednu kartu; */ 

SELECT RezervacijaKarata.idKorisnik AS Korisnik,rezervise.kolicina AS Kol_Rez_Karata, RezervacijaKarata.vreme AS 'Vreme Rezervisanja', izbor.cenaUlaznice AS 'Cena Karte',desavanje.naslov AS 'Za Desavanje',
       lokacija.opis AS 'Odigrava se u',lokacija.naziv AS 'Naziv Mesta',lokacija.adresa,lokacija.grad AS 'U gradu'
FROM desavanje INNER JOIN izbor ON desavanje.id=izbor.idDesavanje
			   INNER JOIN lokacija ON izbor.idLokacija=lokacija.id
			   LEFT OUTER JOIN rezervise ON izbor.id=rezervise.idIzbor
			   RIGHT OUTER JOIN RezervacijaKarata ON rezervise.idRezKarata=RezervacijaKarata.id
WHERE rezervise.kolicina >= 1 \G
