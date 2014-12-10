<?php
	session_start();
	require_once('funkcije.php');
	$poruka = '';
	$link = mysql_connect('localhost', 'root', '');
	$bazaSelektovana = mysql_select_db('vodic', $link);
	if (isset($_POST['komentarbtn']))
	{
		$upit = "INSERT INTO komentar (idKorisnik, idDesavanje, tekst) VALUES (" . $_SESSION['Korisnik']['id'] . "," . $_GET['id'] . ",'" . $_POST['komentar'] . "')";
		mysql_query($upit);
		$poruka = "Hvala na komentaru!";
	}
	else if (isset($_POST['brisanje']))
	{
		$upit = "DELETE FROM komentar WHERE id = " . $_POST['id'];
		mysql_query($upit);
		$poruka = "Uspesno ste obrisali komentar!";
	}
	else if (isset($_POST['ocenabtn']))
	{
		if ($_POST['ocena'] == 0)
		{
			$upit = "DELETE FROM ocenjuje WHERE idKorisnik =" . $_SESSION['Korisnik']['id'] . " AND idDesavanje = " . $_GET['id'];
			mysql_query($upit);
		}
		else
		{
			$upit = "INSERT INTO ocenjuje (idKorisnik, idDesavanje, ocena) VALUES (" . $_SESSION['Korisnik']['id'] . "," . $_GET['id'] . "," . $_POST['ocena'] . ")";
			mysql_query($upit);
			$upit = "UPDATE ocenjuje SET ocena =" . $_POST['ocena'] . " WHERE idKorisnik =" . $_SESSION['Korisnik']['id'] . " AND idDesavanje =" . $_GET['id'];
			mysql_query($upit);
		}
		$poruka = "Hvala na oceni!";
	}
	else if (isset($_POST['rezervacija']))
	{
		if (isset($_SESSION['Korisnik']['adresa']) && isset($_SESSION['Korisnik']['grad']) && isset($_SESSION['Korisnik']['drzava']) && isset($_SESSION['Korisnik']['telefon']))
		{
			$upit = "SELECT izbor.brKarata FROM izbor inner join desavanje on desavanje.id = izbor.idDesavanje where desavanje.id = " . $_GET['id'];
			$rezultat = mysql_query($upit);
			$row = mysql_fetch_assoc($rezultat);
			if ($row['brKarata'] > $_POST['brojkarata'])
			{
				$upit = "UPDATE izbor SET brKarata = " . ($row['brKarata'] - $_POST['brojkarata']) . " WHERE idDesavanje = " . $_GET['id'];
				mysql_query($upit);
				$upit = "INSERT INTO RezervacijaKarata (idKorisnik) VALUES (" . $_SESSION['Korisnik']['id'] . ")";
				mysql_query($upit);
				$upit = "SELECT MAX(id) as id FROM RezervacijaKarata WHERE idKorisnik = " . $_SESSION['Korisnik']['id'];
				$rezultat = mysql_query($upit);
				$row = mysql_fetch_assoc($rezultat);
				$idrk = $row['id'];
				$upit = "SELECT izbor.id FROM lokacija inner join izbor on izbor.idLokacija = lokacija.id
	inner join desavanje on desavanje.id = izbor.idDesavanje WHERE desavanje.id =" . $_GET['id'];
				$rezultat = mysql_query($upit);
				$row = mysql_fetch_assoc($rezultat);
				$idizbor  = $row['id'];
				$upit = "INSERT INTO Rezervise (idIzbor, idRezKarata, kolicina) VALUES (" . $idizbor . "," . $idrk . "," . $_POST['brojkarata'] . ")";
				mysql_query($upit);
				$poruka = 'Uspesno ste rezervisali karte za desavanje!';
			}
			else
			{
				$poruka = "Zao nam je ali karte za izabrano desavanje su rasprodate.";
			}
		}
		else
		{
			$poruka = "Rezervacija neuspesna. Molimo vas da popunite kontakt podatke na vasem profilu!";
		}
	}
	$upit = "SELECT * FROM lokacija inner join izbor on izbor.idLokacija = lokacija.id
	inner join desavanje on desavanje.id = izbor.idDesavanje WHERE desavanje.id =" . $_GET['id'];
	$rezultat = mysql_query($upit);
	$row = mysql_fetch_assoc($rezultat);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vodic</title>

<style type="text/css" media="all">
	@import 'css/styles.css';
</style>

</head>
<body>

<div style="text-align: right">

<?php
	if (isset($_SESSION['Korisnik']))
	{
		echo ($_SESSION['Korisnik']['prezime'] . '   ' . $_SESSION['Korisnik']['ime']);
		echo ('<br />');
		echo ('<a href="?odjava=true">Odjavite se</a>');
	}
	if (isset($_GET['odjava']))
	{
		unset($_SESSION['Korisnik']);
		session_destroy();
		header('Location: prijava.php');
	}
?>

</div>
<h1 style="font-family:arial;color:red;font-size:50px;text-align: center">Dobrodosli na sajt vodic.com</h1>
<div id="main-nav">
<ul>
	<li><a href="index.php">Pocetna</a></li>
	<li><a href="prijava.php">Prijava</a></li>
	<li><a href="registracija.php">Registracija</a></li>
	<li class="active"><a href="desavanja.php">Desavanja</a></li>
	<li><a href="profil.php">Profil</a></li>
</ul>
<div class="clear-both">&nbsp;</div>
</div>
<div style="overflow:auto;margin-bottom:15px;">
	<p style="color:blue;font-weight:bold;"><?php echo ($poruka); ?></p>
<div id="desavanje" style="float:left;">
<h1 style="color:blue;">Desavanje:</h1>

<?php
	echo ('<h2 style="color:blue;display:inline;"><b>Naziv:</b></h2><h2 style="display:inline;"> ' . $row['naslov'] . '</h2>');
	echo ('<p><b>Mesto:</b> ' . $row['naziv'] . '</p>');
	echo ('<p><b>Opis:</b> ' . $row['opis'] . '</p>');
	echo ('<p><b>Cena ulaznice:</b> ' . $row['cenaUlaznice'] . ' din.</p>');
	echo ('<p><b>Vreme:</b> ' . $row['datum'] . '</p>');
	echo ('<p><b>Adresa:</b> ' . $row['adresa'] . '</p>');
	echo ('<p><b>Grad:</b> ' . $row['grad'] . '</p>');
	echo ('<p><b>Email:</b> ' . $row['email'] . '</p>');
	echo ('<p><b>Web:</b> ' . $row['web'] . '</p>');
	echo ('<p><b>Telefon:</b> ' . $row['telefon'] . '</p>');
	$upit     = "SELECT AVG(ocena) as ocena from ocenjuje where idDesavanje =" . $_GET['id'];
	$rezultat = mysql_query($upit);
	if ($rezultat != false)
	{
		$red = mysql_fetch_assoc($rezultat);
		if ($red['ocena'] == null)
			$red['ocena'] = 'nema';
	}
	else
	{
		$red['ocena'] = 'nema';
	}
	echo ('<p><b>Ocena:</b> 	' . substr($red['ocena'], 0, 4) . '</p>');
	if (isset($_SESSION['Korisnik']))
	{
?>

<form action="" method="post">
<span><b>Ocena:</b> </span>
<select name="ocena" id="ocena">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
</select>
<input class="button" type="submit"  value="Oceni" name="ocenabtn" />
</form>
</div>
<div id="rezervacija" style="margin-left:300px;float:left;">
<h2 style="color:blue;">Rezervacija:</h2>
<form action="#" method="post">
	<p>Broj karata:</p>
	<input type="number" name="brojkarata" />
	<input class="button" type="submit" name="rezervacija" value="Rezervisi" />
</form>
</div>
</div>

<?php
	}
?>

<div id="komentari">

<?php
	$upit = "SELECT komentar.tekst, desavanje.idKorisnik, komentar.id, korisnik.ime, korisnik.prezime, korisnik.id as korid FROM komentar INNER JOIN korisnik on
	korisnik.id = komentar.idKorisnik inner join desavanje on desavanje.id = komentar.idDesavanje WHERE desavanje.id =" . $_GET['id'];

	$rezultat = mysql_query($upit);
	$komentari = array();
	
	$html = '';

	while ($red = mysql_fetch_assoc($rezultat))
	{
		$html .= '<div class="komentar">';

		if (isset($_SESSION['Korisnik'])) {
			if ($row['idKorisnik'] == $_SESSION['Korisnik']['id'] || $red['korid'] == $_SESSION['Korisnik']['id'])
			{
				$html .= '<form style="float:right;" method="POST" action="#">';
				$html .= '<input class="buttonkoment" type="submit" value="Obrisi" name="brisanje" />';
				$html .= '<input type="hidden" value="'.$red['id'].'" name="id" />';
				$html .= '</form>';
			}

			if ( $red['korid'] == $_SESSION['Korisnik']['id'])
			{
				$html .= '<form style="float:right;" method="POST" action="izmenaKomentar.php">';
				$html .= '<input class="buttonkoment" type="submit" value="Izmeni" name="izmena" />';
				$html .= '<input type="hidden" name="id" value="'.$red['id'].'" />';
				$html .= '<input type="hidden" name="desavanje" value="'.$_GET['id'].'" />';
				$html .= '</form>';		
			}
		}

		$html .= '<b><p>'.$red['ime'].' '.$red['prezime'].'</p></b>';
		$html .= '<p>'.$red['tekst'].'</p>';

		$html .= '</div>';
	}

	print ($html);
?>

</div>

<?php
	if (isset($_SESSION['Korisnik'])) {
?>

<div id="dodajkomentar">
	<h2 style="color:blue;">Unesite svoj komentar:</h2>
	<form action="#" method="post">
	<textarea name="komentar" id="komentar" cols="150" rows="3"></textarea>
	<input class="button" type="submit" value="Dodaj" name="komentarbtn"/>
	</form>
</div>

<?php
	}
?>

</body>
</html>