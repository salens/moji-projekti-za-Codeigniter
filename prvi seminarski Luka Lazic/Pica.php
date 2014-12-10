<?php

class Pica
{

	private $vrsta;
	private $cena;
	private static $ukupno_prodato = 0;
	const PDV = 0.18;

	public function __construct($vrsta="",$cena=0)
	{
		$this->vrsta = $vrsta;
		$this->cena = $cena;
	}
	
	public function ispisPDV()
	{
		$stopaPDV = self::PDV*100;
		print "Stopa PDVa na picu je $stopaPDV%";
	}

	public function setVrsta($vrsta)
	{
		$this->vrsta = $vrsta;
	}

	public function setCena($cena)
	{
		$this->cena = $cena;
	}

	public function getCena()
	{
		print "Cena jedne pice $this->vrsta je $this->cena dinara.<br /><br />";
	}

	public static function getUkupno()
	{
		print "Do sada je prodato ukupno ".self::$ukupno_prodato." Madjarice pice.<br /><br />";
	}

	private static function setUkupno($komada)
	{
		self::$ukupno_prodato += $komada;
	}

	public function kupi($komada=0)
	{
		$ukupna_cena = ($this->cena + ($this->cena * self::PDV))*$komada ;
		if ($ukupna_cena != 0)
		{
			self::setUkupno($komada);
		}
		print "Kupili ste $komada pica, vrsta: $this->vrsta. Vas racun je $ukupna_cena dinara. <br />";
	}

	
}

?>