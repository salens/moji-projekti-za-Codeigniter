<?php
include_once('klasaSladoled.php');




$cokolada = new Sladoled();

$cokolada->setUkus('čokolade');
$cokolada->setCena(50);
$cokolada->getCena();
$cokolada->kupi(6);


//Konstanta
$vanila->ispisPDV();


//kreiran objekat
$vanila = new Sladoled();
$vanila->setUkus('vanile');
$vanila->setCena(40);
$vanila->getCena();
$vanila->kupi(4);

//staticna
Sladoled::getUkupno();
Sladoled::getUkupno();

?>