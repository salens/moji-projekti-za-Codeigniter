<?php

class Sud
{

	public $id = NULL;
	public $tipSuda = NULL;
	public $grad = NULL;

}

class SudMetode
{

	function citaSudove()
	{
		$konekcija = new Konekcija;
		$sql = "SELECT sud.id,tipSuda.tip, grad.naziv
				FROM tipSuda
				INNER JOIN sud ON sud.idTipSuda = tipSuda.id
				INNER JOIN grad ON grad.id = sud.idGrad";

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
					$sud = new Sud;
					$sud->id = $red['id'];
					$sud->tipSuda = $red['tip'];
					$sud->grad = $red['naziv'];
					$sudovi[] = $sud;
				}

				return $sudovi;			

			}

		}
	}
}
?>