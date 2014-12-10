<?php
include_once('Pica.php');

$madjarica = new Pica();

$madjarica->setVrsta('Madjarica');
$madjarica->setCena(1100);
$madjarica->getCena();
$madjarica->kupi(4);
Pica::getUkupno();

$kapricoza = new Pica();

$kapricoza->setVrsta('Kapricoza');
$kapricoza->setCena(920);
$kapricoza->getCena();
$kapricoza->kupi(8);
Pica::getUkupno();

$kapricoza->ispisPDV();
?>