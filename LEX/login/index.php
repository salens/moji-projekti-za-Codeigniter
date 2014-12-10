<?php

require_once('../_php/require.php');

class Logovanje
{
	private $korIme = NULL;
	private $pass = NULL;
	private $unetoKorIme = NULL;
	private $unetPass = NULL;

	function loguj($unetoKorIme=NULL,$unetPass=NULL)
	{
		$konekcija = new Konekcija;
		$upit = $konekcija->prepare("SELECT korIme,sifra FROM radnik WHERE korIme=?");
		$upit->bindParam(1, $unetoKorIme);
		$upit->execute();

		if ($upit->execute()) {

			$brojRedova = $upit->rowCount();
			if ($brojRedova > 0) {

				$redovi = $upit->fetch(PDO::FETCH_ASSOC);
				if ($unetoKorIme == $redovi['korIme'] && $unetPass == $redovi['sifra'])
				{
					header("Location: http://lapstarr/lex/predmeti/");
				}
				else 
				{
					print "BLAAA";
				}
			}
		}
	}

}

?>