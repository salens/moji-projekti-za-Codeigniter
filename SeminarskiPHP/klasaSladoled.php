<?php

class Sladoled
{

	private $ukus;
	private $cena;
	private static $ukupno_prodato = 0;
	const PDV = 0.2;

	public function __construct($ukus="",$cena=0)
	{
		$this->ukus = $ukus;
		$this->cena = $cena;
	}

	public function setUkus($ukus)
	{
		$this->ukus = $ukus;
	}

	public function setCena($cena)
	{
		$this->cena = $cena;
	}

	public function getCena()
	{
		print "Cena jednog sladoleda od $this->ukus je $this->cena dinara.<br /><br />";
	}

	public static function getUkupno()
	{
		print "Do sada je prodato ukupno ".self::$ukupno_prodato." sladoleda.<br /><br />";
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
		print "Kupili ste $komada sladoled(a) od $this->ukus. Vaš račun je $ukupna_cena dinara. <br />";
	}

	public function ispisPDV()
	{
		$stopaPDV = self::PDV*100;
		print "Stopa PDVa na sladoled je $stopaPDV%";
	}
}

?>