<?php

class Stranka
{
	public $id = NULL;
	public $ime = NULL;
	public $prezime = NULL;
	public $adresa = NULL;
	public $status = NULL;
}

class StrankaMetode
{

	function citaStranke($adresa=NULL,$prezime=NULL)
	{
		$konekcija = new Konekcija;
		$uslov = "";
		$sql = "SELECT stranka.id, stranka.ime, stranka.prezime, stranka.adresa
		FROM stranka";

		if($adresa !=NULL && $prezime != NULL)
		{
			$uslov .= " WHERE predmet.id = ". $idPredmet . " AND radnik.id = ". $radnikId . ";";
		}
		else if($adresa!=NULL)
		{	
			$uslov.= " WHERE stranka.adresa = ". $adresa . ";";

		}
		else if($prezime!=NULL)
		{	
			$uslov.= " WHERE stranka.prezime = ". $prezime . ";";

		}	
	
		$sql .= $uslov;
		$upit = $konekcija->prepare($sql);
		$upit->execute();
		
		if ($upit->execute())
		{
			$brojRedova = $upit->rowCount();
			$stranke = array();
			$redovi = $upit->fetchAll(PDO::FETCH_ASSOC);
			if ($brojRedova > 0) 
			{
				foreach($redovi as $red)
				{
					$stranka = new Stranka;
					$stranka->id = $red['id'];
					$stranka->ime = ucwords($red['ime']);
					$stranka->prezime = ucwords($red['prezime']);
					$stranka->adresa = ucwords($red['adresa']);

					$stranke[] = $stranka;
				}
				$konekcija = null;
				return $stranke;
				
			}

		}

	}

	function dodajStranku($stranka)
	{
		$konekcija = new Konekcija;
		$sql = "INSERT INTO stranka(ime,prezime,adresa,idStatusStranke)
				VALUES('".$stranka->ime."','".$stranka->prezime."','".$stranka->adresa."','".$stranka->status."')
				";

		echo $sql;
		$upit = $konekcija->prepare($sql);
		$upit->execute();
	}

	function citaStatuse()
	{
		$konekcija = new Konekcija;
		$sql = "select id,status from statusStranke";

		$upit = $konekcija->prepare($sql);
		$upit->execute();

		if ($upit->execute())
		{
			$brojRedova = $upit->rowCount();
			$statusi = array();
			$redovi = $upit->fetchAll(PDO::FETCH_ASSOC);
			if ($brojRedova > 0) 
			{
				foreach($redovi as $red)
				{
					$statusi[] = $red;
				}
				return $statusi;
				
			}

		}

	}
}

?>