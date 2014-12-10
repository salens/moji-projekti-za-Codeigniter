<?php

class Validacija
{
	public $validno;
	public $poruka;
	public $vracenaVrednost;

}

class ValidacijaMetode
{
	function validiraj($ulaz, $tip)
	{
		$validacija = new Validacija();
		$validacija->validno = false;
		$validacija->poruka = '';
		$validacija->vracenaVrednost = false;

		$ulaz = array_map('trim', $ulaz);

		switch ($tip) {
			case 'stranka':
			foreach ($ulaz as $key => $value) {
				if(empty($value))
				{
					$validacija->poruka = 'Polja ne mogu biti prazna';
					$validacija->validno = false;
					$validacija->vracenaVrednost = false;
					break;
				}
				else
				{
					$validacija->validno = true;		
					$validacija->poruka = 'Stranka je uspešno dodata';
					$validacija->vracenaVrednost = true;
				}
				
			}

			if ($validacija->validno)
			{
				$stranka = new Stranka;
				$strankaMetode = new StrankaMetode;
				$stranka->ime = $ulaz['imeStranke'];
				$stranka->prezime = $ulaz['prezimeStranke'];
				$stranka->adresa = $ulaz['adresaStranke'];
				$stranka->status = $ulaz['statusStranke'];

				$vracenaVrednost = $strankaMetode->dodajStranku($stranka);
			}
			break;

			case 'predmet':
			foreach ($ulaz as $key => $value) {

				if(empty($value))
				{
					if($key == 'vrednost' || $key == 'lokacija')
						continue;

					$validacija->poruka = 'Polja ne mogu biti prazna';
					$validacija->validno = false;
					$validacija->vracenaVrednost = false;
					break;
				}
				else
				{
					$validacija->validno = true;		
					$validacija->poruka = 'Predmet je uspešno dodat';
					$validacija->vracenaVrednost = true;
				}
				
			}

			if ($validacija->validno)
			{
				$predmet = new Predmet;
				$predmetMetode = new predmetMetode;

				$predmet->brojPredmeta = $ulaz['brojPredmeta'];
				$predmet->sudskiBroj = $ulaz['sudskiBroj'];
				$predmet->vrednost = $ulaz['vrednost'];
				$predmet->lokacija = $ulaz['lokacija'];
				$predmet->idVrsta = $ulaz['vrsta'];

				$vracenaVrednost = $predmetMetode->dodajPredmet($predmet);
			}
			break;

			case 'pretraga':
			foreach ($ulaz as $key => $value) {
				if(empty($value))
				{
					$validacija->poruka = 'Polja ne mogu biti prazna';
					$validacija->validno = false;
					$validacija->vracenaVrednost = false;
					break;
				}
				else
				{
					$validacija->validno = true;
					$validacija->vracenaVrednost = true;
				}
				
			}

			if ($validacija->validno)
			{
				$rezultat = new Rezultat;
				$rezultatMetode = new RezultatMetode;

				$vracenaVrednost = $rezultatMetode->pretrazi($ulaz);
			}
			break;
			case 'izmena':
			foreach ($ulaz as $key => $value) {
				if(empty($value))
				{
					if($key == 'vrednost' || $key == 'lokacija')
						continue;

					$validacija->poruka = 'Polja ne mogu biti prazna';
					$validacija->validno = false;
					$validacija->vracenaVrednost = false;
					break;
				}
				else
				{
					$validacija->validno = true;		
					$validacija->poruka = 'Predmet je uspešno dodat';
					$validacija->vracenaVrednost = true;
				}
				
			}

			if ($validacija->validno)
			{

				$predmetMetode = new predmetMetode;
				$vracenaVrednost = $predmetMetode->izmeniPredmet($ulaz);

			}
			else
				print 'NIJE VALIDNo';
			break;
			
			default:
				# code...
			break;
		}

		return $validacija->vracenaVrednost;

	}
}
?>