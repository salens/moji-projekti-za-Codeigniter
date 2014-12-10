<?php

include_once('Prijatelj.php');

//Kreiran objekat za prosledjivanje vrednosti u Konstruktor
$osoba = new Prijatelj("Filip","Vajgand", 1990);
$osoba->getInfo();

// Kreiran objekat
$poz = new Prijatelj;

echo "<br>"."Filipovo drustvo su:".$poz->drustvo("Marko","Zarko","Mirko");

      
//Kreirani Objekti
$prijatelj_1 = new Prijatelj;     
$prijatelj_1->josPrijatelja("Marko","Dundjer", 1993); 

$prijatelj_2 = new Prijatelj;  
$prijatelj_2->josPrijatelja("Filip","Dundjer", 1991);

$prijatelj_3 = new Prijatelj;  
$prijatelj_3->josJedanPrijatelj("Stanislav","Sencanski", 1891);

//Ispisivanje Objekata

echo "<br><br> Jos Prijatelja: <br><br>";    

echo $prijatelj_1 . '<br>';   

echo $prijatelj_2 . '<br>';    

echo $prijatelj_3 . '<br>';   


//Poziv Staticke metode preko kreiranog objekta

$odgovor = new Prijatelj;
$odgovor = Prijatelj::Odgovor1();
echo '<br>';
$odgovor = Prijatelj::Odgovor2();
echo '<br>';
$odgovor = Prijatelj::Odgovor3();

?>
