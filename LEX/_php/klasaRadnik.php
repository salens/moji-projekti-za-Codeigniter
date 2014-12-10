<?php

require_once('require.php');

class Radnik
{
	public $ime = NULL;
	public $prezime = NULL;
	public $nivo = NULL;
	public $id = NULL;
	public $korIme = NULL;

}

class RadnikMetode
{
	function citaPodatke()
	{

		$radnik = new Radnik;
		$konekcija = new Konekcija;

		$sql = "SELECT radnik.id,radnik.ime,radnik.prezime,radnik.korIme,nivoPristupa.nivo
		FROM radnik inner join nivoPristupa on
		radnik.idNivoPristupa = nivoPristupa.id
		WHERE radnik.korIme = '" . $_POST['korIme'] . "';";
		$upit = $konekcija->prepare($sql);
		$upit->execute();

		if ($upit->execute())
		{
			$brojRedova = $upit->rowCount();			
			if ($brojRedova > 0) 
			{

				$redovi = $upit->fetch(PDO::FETCH_ASSOC);
				$radnik->ime = $redovi['ime'];
				$radnik->prezime = $redovi['prezime'];
				$radnik->nivo = $redovi['nivo'];
				$radnik->id = $redovi['id'];
				$radnik->korIme = $redovi['korIme'];				
				
			}
		}
		return $radnik;
	}

	function citaRadnike()
	{
		
		$konekcija = new Konekcija;
		$sql = "SELECT id,ime,prezime from radnik";

		$upit = $konekcija->prepare($sql);
		$upit->execute();
		$radnici = array();

		if ($upit->execute())
		{
			$brojRedova = $upit->rowCount();
			$vrstePostupka = array();
			$redovi = $upit->fetchAll(PDO::FETCH_ASSOC);
			if ($brojRedova > 0) 
			{
				foreach($redovi as $red)
				{
					$radnik = new Radnik;
					$radnik->id = $red['id'];
					$radnik->ime = $red['ime'];
					$radnik->prezime = $red['prezime'];
					$radnici[] = $radnik;
				}

				return $radnici;

				

			}

		}

	}

}

?>