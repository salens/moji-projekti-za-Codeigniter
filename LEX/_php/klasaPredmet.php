<?php
class Predmet
{

	public $id = NULL;
	public $brojPredmeta = NULL;
	public $sudskiBroj = NULL;
	public $vrstaPostupka = NULL;
	public $vrednost = NULL;
	public $ime = NULL;
	public $prezime = NULL;
	public $datumVreme = NULL;
	public $status = NULL;
	public $radnikIme = NULL;
	public $zaduzenIme = NULL;
	public $lokacija = NULL;
	public $zaduzenPrezime;
	public $tuzeni;
	public $datumRasprava;
	public $vremeRasprava;
	public $sud;
}

class PredmetMetode
{
	function citaSvePredmete($idPredmet = NULL,$radnikId = NULL)
	{	
		$konekcija = new Konekcija;
		$uslov = "";
		$sql = "SELECT predmet.id,predmet.brojPredmeta,predmet_radnik.idRadnik,predmet.lokacija, predmet.vrednost, CONCAT(rasprava.datum, ' ',rasprava.vreme) as 'datumRasprava',predmet.sudskiBroj, tuzba.datumVreme, statusPredmeta.status, radnik.ime as 'imeR', radnik.prezime as 'prezimeR',stranka.ime, stranka.prezime, vrstaPostupka.vrsta,CONCAT(tipSuda.tip, ' ',grad.naziv) as 'sud'
		FROM predmet
		INNER JOIN tuzba ON predmet.id = tuzba.idPredmet
		INNER JOIN stranka ON tuzba.idStranka = stranka.id
		INNER JOIN predmet_status ON predmet.id = predmet_status.idPredmet
		INNER JOIN statusPredmeta ON predmet_status.idStatusPredmeta = statusPredmeta.id
		INNER JOIN predmet_radnik ON predmet.id = predmet_radnik.idPredmet
		INNER JOIN vrstaPostupka ON predmet.idVrsta = vrstaPostupka.id
		INNER JOIN radnik ON radnik.id = predmet_radnik.idRadnik
		INNER JOIN predmet_sud on predmet.id = predmet_sud.idPredmet
		INNER JOIN sud on sud.id = predmet_sud.idSud
		INNER JOIN tipSuda on tipSuda.id = sud.idTipSuda
		INNER JOIN grad on grad.id = sud.idGrad
		INNER JOIN rasprava on predmet.id = rasprava.idPredmet
		WHERE tuzba.podneo = 1

		";
		if($radnikId !=NULL && $idPredmet != NULL)
		{
			$uslov .= " AND predmet.id = ". $idPredmet . " AND radnik.id = ". $radnikId . " GROUP BY predmet.brojPredmeta ORDER BY predmet.id ASC";
		}
		else if($idPredmet!=NULL)
		{	
			$uslov.= " AND predmet.id = ". $idPredmet . " GROUP BY predmet.brojPredmeta ORDER BY predmet.id ASC";

		}
		else if($radnikId!=NULL)
		{	
			$uslov.= " AND radnik.id = ". $radnikId . " GROUP BY predmet.brojPredmeta ORDER BY predmet.id ASC";

		}
		else
			$uslov = " GROUP BY predmet.brojPredmeta ORDER BY predmet.id ASC";

		$sql .= $uslov;

		$upit = $konekcija->prepare($sql);
		$upit->execute();

		
		if ($upit->execute())
		{
			$brojRedova = $upit->rowCount();
			$predmeti = array();
			$redovi = $upit->fetchAll(PDO::FETCH_ASSOC);

			if ($brojRedova > 0) 
			{
				foreach($redovi as $red)
				{

					$predmet = new Predmet;
					$predmet->id = $red['id'];
					$predmet->ime = ucfirst($red['ime']);
					$predmet->prezime = ucfirst($red['prezime']);
					$predmet->brojPredmeta = strtoupper($red['brojPredmeta']);
					$predmet->sudskiBroj = strtoupper($red['sudskiBroj']);				
					$predmet->datumVreme = date('d.m.Y.', strtotime($red['datumVreme']));
					$predmet->status = ucfirst($red['status']);
					$predmet->vrstaPostupka = ucfirst($red['vrsta']);
					$predmet->sud = ucfirst($red['sud']);
					$predmet->brojPredmeta = strtoupper($red['brojPredmeta']);					
					$predmet->radnikPredmet = $red['idRadnik'];
					$predmet->vrednost = $red['vrednost'];
					$predmet->zaduzenIme = ucfirst($red['imeR']);
					$predmet->lokacija = $red['lokacija'];
					$predmet->datumRasprava = date('d.m.Y.', strtotime($red['datumRasprava']));
					$predmet->zaduzenPrezime = ucfirst($red['prezimeR']);
					$predmeti[] = $predmet;
				}

				return $predmeti;
			}
		}

	}

	function dodajPredmet($predmet)
	{
		$konekcija = new Konekcija;
		$sqlPredmet = "INSERT INTO predmet(brojPredmeta,sudskiBroj,idVrsta,vrednost,lokacija)
		VALUES('".$predmet->brojPredmeta."','".$predmet->sudskiBroj."','".$predmet->idVrsta."','".$predmet->vrednost."','".$predmet->lokacija."')";

		$upit = $konekcija->prepare($sqlPredmet);
		$upit->execute();

		$sqlId = "select id from predmet where brojPredmeta = '".$predmet->brojPredmeta."'";
		$upitId = $konekcija->prepare($sqlId);
		$upit->execute();

		$_GET['id'] = '';
		if($upitId->execute())
		{
			$redovi = $upitId->fetchAll(PDO::FETCH_ASSOC);

			foreach($redovi as $red)
			{
				$_GET['id'] = $red['id'];
			}
		}

		$sqlStatus = "INSERT INTO predmet_status (idPredmet,idStatusPredmeta) VALUES('".$_GET['id']."',1)";
		$upitStatus = $konekcija->prepare($sqlStatus);
		$upitStatus->execute();

		$sqlPredmet_Radnik = "INSERT INTO predmet_radnik (idPredmet,idRadnik,vodja) VALUES('".$_GET['id']."','".$_POST['idRadnik']."',1)";
		$upitPredmet_Radnik = $konekcija->prepare($sqlPredmet_Radnik);
		$upitPredmet_Radnik->execute();

		$sqlPredmet_Sud = "INSERT INTO predmet_sud (idPredmet,idSud) VALUES('".$_GET['id']."','".$_POST['sud']."')";
		$upitPredmet_Sud = $konekcija->prepare($sqlPredmet_Sud);
		$upitPredmet_Sud->execute();

		$sqlTuzba = "INSERT INTO tuzba (idPredmet,idStranka,podneo) VALUES('".$_GET['id']."','".$_POST['tuzilac']."',1), ('".$_GET['id']."','".$_POST['tuzeni']."',0)";
		$sqlTuzba = $konekcija->prepare($sqlTuzba);
		$sqlTuzba->execute();

		$sqlRasprava = "INSERT INTO rasprava (idPredmet,idSud,datum) VALUES('".$_GET['id']."','".$_POST['sud']."',CURRENT_TIMESTAMP)";
		$sqlRasprava = $konekcija->prepare($sqlRasprava);
		$sqlRasprava->execute();

	}

	function izmeniPredmet($predmet)
	{
		$konekcija = new Konekcija;

		$tempVrednost = explode(' ', $predmet['vrednost']);

		$sqlPredmet = "UPDATE predmet SET brojPredmeta='".$predmet['brojPredmeta']."',sudskiBroj='".$predmet['sudskiBroj']."',idVrsta='".$predmet['idVrsta']."',vrednost='".$tempVrednost[0]."', lokacija='".$predmet['lokacija']."' WHERE id='".$_GET['id']."'";

		$upit = $konekcija->prepare($sqlPredmet);
		$upit->execute();

		$sqlStatus = "INSERT INTO predmet_status (idPredmet,idStatusPredmeta) VALUES('".$_GET['id']."','".$predmet['idStatus']."')";
		$upitStatus = $konekcija->prepare($sqlStatus);
		$upitStatus->execute();
		print $sqlStatus;
		$sqlPredmet_Radnik = "UPDATE predmet_radnik SET idRadnik='".$predmet['radnik']."' WHERE idPredmet = '".$_GET['id']."' and idRadnik='".$predmet['radnik']."'";
		$upitPredmet_Radnik = $konekcija->prepare($sqlPredmet_Radnik);
		$upitPredmet_Radnik->execute();

		$sqlPredmet_Sud = "UPDATE predmet_sud SET idSud='".$predmet['sud']."' WHERE idPredmet = '".$_GET['id']."'";
		$upitPredmet_Sud = $konekcija->prepare($sqlPredmet_Sud);
		$upitPredmet_Sud->execute();

		$sqlTuzba = "INSERT INTO tuzba (idPredmet,idStranka,podneo) VALUES('".$_GET['id']."','".$_POST['tuzilac']."',1), ('".$_GET['id']."','".$_POST['tuzeni']."',0)";
		$upitTuzba = $konekcija->prepare($sqlTuzba);
		$upitTuzba->execute();

	}

	function obrisiPredmet($predmetId)
	{
		$konekcija = new Konekcija;
		$obrisano = false;

		$sqlTuzba = "DELETE FROM tuzba WHERE idPredmet='".$predmetId."'";
		$upitTuzba = $konekcija->prepare($sqlTuzba);
		$upitTuzba->execute();
		if($upitTuzba->execute())
		{
			$obrisano = true;
		}
		else
		{
			$obrisano = false;
		}
		return $obrisano;

	}

	function citaVrste()
	{
		$konekcija = new Konekcija;
		$sql = "select id,vrsta from vrstaPostupka";

		$upit = $konekcija->prepare($sql);
		$upit->execute();

		if ($upit->execute())
		{
			$brojRedova = $upit->rowCount();
			$vrstePostupka = array();
			$redovi = $upit->fetchAll(PDO::FETCH_ASSOC);
			if ($brojRedova > 0) 
			{
				foreach($redovi as $red)
				{
					$vrstePostupka[] = $red;
				}
				return $vrstePostupka;

			}

		}
	}

	function citaStatuse()
	{
		$konekcija = new Konekcija;
		$sql = "select id,status from statusPredmeta";

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