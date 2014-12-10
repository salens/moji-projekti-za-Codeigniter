<?php
	function prijava($email, $lozinka)
	{
		$rezultat = false;
		if (!empty($email) && !empty($lozinka))
		{
			$link = mysql_connect('localhost', 'root', '');
			if ($link)
			{
				$bazaSelektovana = mysql_select_db('vodic', $link);
				if ($bazaSelektovana)
				{
					$upit          = 'select * FROM korisnik WHERE email="' . $email . '" and lozinka="' . $lozinka . '";';
					$rezultatUpita = mysql_query($upit);
					if (is_resource($rezultatUpita))
					{
						if (mysql_num_rows($rezultatUpita) > 0)
						{
							$rezultat = mysql_fetch_array($rezultatUpita, MYSQL_ASSOC);
						}
						else
						{
							$rezultat = 'korisnik sa kombinacijom email-a i lozinke koja je unesena ne postoji.';
						}
					}
					else
					{
						$rezultat = mysql_errno($link) . ': ' . mysql_error($link) . '<br />';
					}
				}
				else
				{
					$rezultat = 'Došlo je do greške prilikom biranja baze podataka.<br />';
				}
				mysql_close($link);
			}
			else
			{
				$rezultat = 'Greska u konektovanju sa bazom podataka se ne može uspostaviti.<br />';
			}
		}
		else
		{
			$rezultat = 'Obavezni argumenti funkcije nisu prosleđeni.<br />';
		}
		return $rezultat;
	}
	function registracija($tip, $ime, $prezime, $email, $lozinka, $brtelefona, $drzava, $adresa, $grad, $facebook, $twitter, $linkedin, $google)
	{
		$podaci   = array(
			'telefon' => $brtelefona,
			'drzava' => $drzava,
			'adresa' => $adresa,
			'grad' => $grad,
			'facebook' => $facebook,
			'twiter' => $twitter,
			'linkedin' => $linkedin,
			'google' => $google
		);
		$rezultat = false;
		if (!empty($ime) && !empty($prezime) && !empty($email) && !empty($lozinka))
		{
			$link = mysql_connect('localhost', 'root', '');
			if ($link)
			{
				$bazaSelektovana = mysql_select_db('vodic', $link);
				if ($bazaSelektovana)
				{
					$upit = 'INSERT INTO korisnik (tip, ime, prezime, email, lozinka';
					foreach ($podaci as $kljuc => $podatak)
					{
						if (!empty($podatak))
							$upit .= ", $kljuc";
					}
					$upit .= ') values (' . $tip . ',"' . $ime . '","' . $prezime . '", "' . $email . '","' . $lozinka . '"';
					foreach ($podaci as $kljuc => $podatak)
					{
						if (!empty($podatak))
							$upit .= ',"' . $podatak . '"';
					}
					$upit .= ')';
					$rezultatUpita = mysql_query($upit);
					if ($rezultatUpita)
					{
						$rezultat = true;
					}
					else
					{
						$rezultat = false;
					}
				}
				else
				{
					$rezultat = 'Došlo je do greške prilikom selektovanja baze podataka.<br />';
				}
				mysql_close($link);
			}
			else
			{
				$rezultat = 'Konekcija sa bazom podataka se ne može uspostaviti.<br />';
			}
		}
		else
		{
			$rezultat = 'Obavezni podaci nisu upisani.<br />';
		}
		return $rezultat;
	}
	function izmeniSifru($novalozinka, $idKorisnik)
	{
		$rezultat = false;
		if (!empty($novalozinka))
		{
			$link = mysql_connect('localhost', 'root', '');
			if ($link)
			{
				$bazaSelektovana = mysql_select_db('vodic', $link);
				if ($bazaSelektovana)
				{
					$upit     = 'UPDATE korisnik SET lozinka="' . $novalozinka . '" WHERE id="' . $idKorisnik . '"';
					$rezultat = mysql_query($upit);
				}
				else
				{
					$rezultat = 'Došlo je do greške prilikom selektovanja baze podataka.<br />';
				}
				mysql_close($link);
			}
			else
			{
				$rezultat = 'Konekcija sa bazom podataka se ne može uspostaviti.<br />';
			}
			return $rezultat;
		}
	}
	function CitaGrupe()
	{
		$rezultat = false;
		$link     = mysql_connect('localhost', 'root', '');
		if ($link)
		{
			$bazaSelektovana = mysql_select_db('vodic', $link);
			if ($bazaSelektovana)
			{
				$upit  = 'SELECT id, naziv FROM grupa WHERE idNadgrupa IS NULL';
				$rez   = mysql_query($upit);
				$grupe = array();
				while ($red = mysql_fetch_array($rez))
				{
					$grupe[] = $red;
				}
			}
			else
			{
				$rezultat = 'Došlo je do greške prilikom selektovanja baze podataka.<br />';
			}
			mysql_close($link);
		}
		else
		{
			$rezultat = 'Konekcija sa bazom podataka se ne može uspostaviti.<br />';
		}
		return $grupe;
	}
	function citaPodGrupe($idgrupe)
	{
		$rezultat = false;
		$link     = mysql_connect('localhost', 'root', '');
		if ($link)
		{
			$bazaSelektovana = mysql_select_db('vodic', $link);
			if ($bazaSelektovana)
			{
				$upit     = 'SELECT id,naziv FROM grupa WHERE idNadgrupa=' . $idgrupe;
				$rez      = mysql_query($upit);
				$podgrupe = array();
				while ($red = mysql_fetch_array($rez))
				{
					$podgrupe[] = $red;
				}
			}
			else
			{
				$rezultat = 'Došlo je do greške prilikom selektovanja baze podataka.<br />';
			}
			mysql_close($link);
		}
		else
		{
			$rezultat = 'Konekcija sa bazom podataka se ne može uspostaviti.<br />';
		}
		return $podgrupe;
	}
	function citaSvePodGrupe()
	{
		$rezultat = false;
		$link     = mysql_connect('localhost', 'root', '');
		if ($link)
		{
			$bazaSelektovana = mysql_select_db('vodic', $link);
			if ($bazaSelektovana)
			{
				$upit     = 'SELECT id,naziv FROM grupa WHERE idNadgrupa IS NOT NULL';
				$rez      = mysql_query($upit);
				$podgrupe = array();
				while ($red = mysql_fetch_array($rez))
				{
					$podgrupe[] = $red;
				}
			}
			else
			{
				$rezultat = 'Došlo je do greške prilikom selektovanja baze podataka.<br />';
			}
			mysql_close($link);
		}
		else
		{
			$rezultat = 'Konekcija sa bazom podataka se ne može uspostaviti.<br />';
		}
		return $podgrupe;
	}
	function citaDesavanja()
	{
		$rezultat = false;
		$link     = mysql_connect('localhost', 'root', '');
		if ($link)
		{
			$bazaSelektovana = mysql_select_db('vodic', $link);
			if ($bazaSelektovana)
			{
				$upit = 'SELECT desavanje.id,korisnik.ime,korisnik.prezime,lokacija.opis,desavanje.tekst,desavanje.naslov,lokacija.naziv,tag.naziv AS tag,izbor.datum,izbor.cenaUlaznice,izbor.brKarata,lokacija.grad FROM desavanje 
						INNER JOIN korisnik ON desavanje.idKorisnik=korisnik.id
						INNER JOIN pridruzuje ON desavanje.id=pridruzuje.idDesavanje
						INNER JOIN tag ON pridruzuje.idTag=tag.id
						INNER JOIN izbor ON desavanje.id=izbor.idDesavanje
						INNER JOIN lokacija ON izbor.idLokacija=lokacija.id;';
				$rez = mysql_query($upit);
				$desavanja = array();
				while ($red = mysql_fetch_assoc($rez))
				{
					$desavanja[] = $red;
				}
			}
			else
			{
				$rezultat = 'Došlo je do greške prilikom selektovanja baze podataka.<br />';
			}
			mysql_close($link);
		}
		else
		{
			$rezultat = 'Konekcija sa bazom podataka se ne može uspostaviti.<br />';
		}
		return $desavanja;
	}
	function izmenaPodataka($podaci)
	{
		$rezultat = false;
		if (!empty($podaci['ime']) && !empty($podaci['prezime']) && !empty($podaci['email']))
		{
			$link = mysql_connect('localhost', 'root', '');
			if ($link)
			{
				$bazaSelektovana = mysql_select_db('vodic', $link);
				if ($bazaSelektovana)
				{
					$upit = 'UPDATE korisnik SET ';
					foreach ($podaci as $kljuc => $podatak)
					{
						if (!empty($podatak))
							$upit .= "$kljuc = '$podatak',";
					}
					$upit = substr($upit, 0, strlen($upit) - 1);
					$upit .= ' WHERE id =' . $_SESSION['Korisnik']['id'];
					$rezultatUpita = mysql_query($upit);
					if ($rezultatUpita)
					{
						$rezultat = true;
					}
					else
					{
						$rezultat = false;
					}
				}
				else
				{
					$rezultat = 'Došlo je do greške prilikom selektovanja baze podataka.<br />';
				}
				mysql_close($link);
			}
			else
			{
				$rezultat = 'Konekcija sa bazom podataka se ne može uspostaviti.<br />';
			}
		}
		else
		{
			$rezultat = 'Obavezni podaci nisu upisani.<br />';
		}
		return $rezultat;
	}
	function dodajDesavanje($podaci)
	{
		$tagovi = explode(",", $podaci['tagovi']);
		unset($podaci['tagovi']);
		$upit = "INSERT INTO desavanje (idKorisnik, idGrupa, naslov, tekst) VALUES (
			" . $_SESSION['Korisnik']['id'] . "," . $podaci['grupa'] . ",'" . $podaci['naslov'] . "','" . $podaci['opis'] . "'
			)";
		mysql_query($upit);
		$upit  = "SELECT MAX(id) as id FROM desavanje WHERE idKorisnik = " . $_SESSION['Korisnik']['id'];
		$rezultat = mysql_query($upit);
		$row   = mysql_fetch_assoc($rezultat);
		$id    = $row['id'];
		$upit     = "INSERT INTO izbor (idDesavanje, idLokacija, cenaUlaznice, datum, brKarata) VALUES (
			" . $id . "," . $podaci['lokacija'] . "," . $podaci['cena'] . ",'" . $podaci['vreme'] . "'," . $podaci['brojKarata'] . "
			)";
		mysql_query($upit);
		$upit = "INSERT INTO tag (naziv) VALUES ";
		foreach ($tagovi as $tag)
		{
			$upit .= "('" . $tag . "'),";
		}
		$upit = substr($upit, 0, strlen($upit) - 1);
		mysql_query($upit);
		$upit   = "SELECT * from TAG ORDER BY id DESC LIMIT " . count($tagovi);
		$rezultat = mysql_query($upit);
		$upit   = "INSERT INTO pridruzuje (idDesavanje, idTag) VALUES ";
		while ($row = mysql_fetch_assoc($rezultat))
		{
			$upit .= '(' . $id . ',' . $row['id'] . '),';
		}
		$upit = substr($upit, 0, strlen($upit) - 1);
		mysql_query($upit);
	}
	function izmeniDesavanje($podaci, $desavanje)
	{
		$tagovi = explode(",", $podaci['tagovi']);
		unset($podaci['tagovi']);
		$upit = "UPDATE desavanje SET idKorisnik = " . $_SESSION['Korisnik']['id'] . ", idGrupa = " . $podaci['grupa'] . ", naslov ='" . $podaci['naslov'] . "', tekst = '" . $podaci['opis'] . "' WHERE id =" . $desavanje;
		mysql_query($upit);
		$upit     = "SELECT id FROM izbor WHERE idDesavanje =" . $desavanje . ' AND idLokacija =' . $podaci['lokacija'];
		$rezultat = mysql_query($upit);
		$row      = mysql_fetch_assoc($rezultat);
		$upit     = "UPDATE izbor SET idDesavanje=" . $desavanje . ", idLokacija=" . $podaci['lokacija'] . ", cenaUlaznice=" . $podaci['cena'] . ", datum='" . $podaci['vreme'] . "', brKarata=" . $podaci['brojKarata'] . " WHERE id =" . $row['id'];
		mysql_query($upit);
		$upit = "DELETE FROM tag WHERE idDesavanje =" . $desavanje;
		mysql_query($upit);
		$upit = "INSERT INTO tag (naziv) VALUES ";
		foreach ($tagovi as $tag)
		{
			$upit .= "('" . $tag . "'),";
		}
		$upit = substr($upit, 0, strlen($upit) - 1);
		mysql_query($upit);
		$upit  = "SELECT * from TAG ORDER BY id DESC LIMIT " . count($tagovi);
		$rezultat = mysql_query($upit);
		$upit  = "INSERT INTO pridruzuje (idDesavanje, idTag) VALUES ";
		while ($red = mysql_fetch_assoc($rezultat))
		{
			$upit .= '(' . $row['id'] . ',' . $red['id'] . '),';
		}
		$upit = substr($upit, 0, strlen($upit) - 1);
		mysql_query($upit);
	}
?>