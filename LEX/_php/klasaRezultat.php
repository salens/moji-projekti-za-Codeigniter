<?php

class Rezultat
{
	public $vrednost;
}

class RezultatMetode
{
	
	function pretrazi($ulaz)
	{
		$konekcija = new Konekcija;
		$sql = "SELECT predmet.id, predmet.brojPredmeta, predmet.sudskiBroj, tuzba.datumVreme, statusPredmeta.status, radnik.ime as 'imeR', radnik.prezime as 'prezimeR',stranka.ime, stranka.prezime
		FROM predmet
		INNER JOIN tuzba ON predmet.id = tuzba.idPredmet
		INNER JOIN stranka ON tuzba.idStranka = stranka.id
		INNER JOIN predmet_status ON predmet.id = predmet_status.idPredmet
		INNER JOIN statusPredmeta ON predmet_status.idStatusPredmeta = statusPredmeta.id
		INNER JOIN predmet_radnik ON predmet.id = predmet_radnik.idPredmet
		INNER JOIN radnik ON radnik.id = predmet_radnik.idRadnik"; 

		if(isset($ulaz['parametar'])){

			if($ulaz['parametar'] == 'brojPredmeta' || $ulaz['parametar' == 'sudskiBroj'])
			{			
				$sql .= " WHERE predmet.".$ulaz['parametar']." LIKE '%".$ulaz['vrednost']."%' GROUP BY predmet.id";			
			}
			elseif ($ulaz['parametar'] == 'prezime')
			{
				$sql .= " WHERE stranka.".$ulaz['parametar']." LIKE '%".$ulaz['vrednost']."%' GROUP BY predmet.id";
			}
		}
		$upit = $konekcija->prepare($sql);
		$upit->execute();

		if ($upit->execute())
		{
			$brojRedova = $upit->rowCount();
			$rezultati = array();
			$redovi = $upit->fetchAll(PDO::FETCH_ASSOC);
			if ($brojRedova > 0) 
			{
				foreach($redovi as $red)
				{
					$rezultat = new Rezultat;
					$rezultati[] = $red;
				}

				
			}
		}

		return $rezultati;
	}
}
?>