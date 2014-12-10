<?php
	session_start();
	require_once('funkcije.php');
	$link = mysql_connect('localhost', 'root', '');
	$bazaSelektovana = mysql_select_db('vodic', $link);
	if (isset($_GET['btn']))
	{
		$upit = "SELECT korisnik.ime,desavanje.id,korisnik.prezime,lokacija.opis,desavanje.tekst,desavanje.naslov,lokacija.naziv,izbor.datum,izbor.cenaUlaznice,izbor.brKarata,lokacija.grad FROM desavanje 
						INNER JOIN korisnik ON desavanje.idKorisnik=korisnik.id
						INNER JOIN izbor ON desavanje.id=izbor.idDesavanje
						INNER JOIN lokacija ON izbor.idLokacija=lokacija.id WHERE desavanje.naslov LIKE '%" . $_GET['upit'] . "%' OR lokacija.naziv LIKE '%" . $_GET['upit'] . "%' OR lokacija.grad LIKE '%" . $_GET['upit'] . "%'";
		mysql_query($upit);
	}
	else if (isset($_GET['grupa']))
	{
		$upit = "SELECT desavanje.id,korisnik.ime,korisnik.prezime,lokacija.opis,desavanje.tekst,desavanje.naslov,lokacija.naziv,izbor.datum,izbor.cenaUlaznice,izbor.brKarata,lokacija.grad FROM desavanje 
						INNER JOIN korisnik ON desavanje.idKorisnik=korisnik.id
						INNER JOIN izbor ON desavanje.id=izbor.idDesavanje
						INNER JOIN lokacija ON izbor.idLokacija=lokacija.id
						INNER JOIN grupa ON desavanje.idGrupa = grupa.id WHERE grupa.id =" . $_GET['grupa'] . " OR idNadgrupa =" . $_GET['grupa'];
	}
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
	if (isset($_SESSION['Korisnik'])) {
		echo ($_SESSION['Korisnik']['prezime'] . '   ' . $_SESSION['Korisnik']['ime']);
		echo ('<br />');
		echo ('<a href="?odjava=true">Odjavite se</a>');
	}
	if (isset($_GET['odjava']))
	{
		unset($_SESSION['Korisnik']);
		session_destroy();
		header('Location: index.php');
	}
?>
										
</div>		
<h1 style="font-family:arial;color:red;font-size:50px;text-align: center">Dobrodosli na sajt vodic.com</h1>
<div id="main-nav">
	<ul>
		<li ><a href="index.php">Pocetna</a></li>
		<li><a href="prijava.php">Prijava</a></li>
		<li><a href="registracija.php">Registracija</a></li>
		<li class="active"><a href="desavanja.php">Desavanja</a></li>
		<li><a href="profil.php">Profil</a></li>
	</ul>
	<div class="clear-both">&nbsp;</div>
</div>
<div id="desavanje">
<form action="#" method="get">
	<h2 style="font-family:arial;color:blue;"><p>Pretraga desavanja:</p></h2>
	<table class="tablestil">
		<tr>
			<td>Unesite Desavanje:</td>
			<td><input type="text" name="upit" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="btn" value="Pretrazi" /></td>
		</tr>
		</table>
	</form>	
<table border="1" id="tabledesavanja" style="margin-top:15px;">

<?php
	$desavanjaTabela = '<table border="1">';
	if (isset($_GET['btn']))
	{
		$result = mysql_query($upit);
		while ($row = mysql_fetch_assoc($result))
		{
			$desavanja[] = $row;
		}
	}
	else if (isset($_GET['grupa']))
	{
		$result = mysql_query($upit);
		while ($row = mysql_fetch_assoc($result))
		{
			$desavanja[] = $row;
		}
	}
	else
	{
		$desavanja = citaDesavanja();
	}
	
	if (isset($desavanja))
	{
		$desavanjaTabela = '<th>Ime</th><th>Prezime</th><th>Mesto</th><th>Naziv Mesta</th><th>Opis Desavanja</th><th>Desavanje</th><th>Tag</th><th>Vreme</th><th>cena Ulaznice</th><th>Broj Karata</th><th>Grad</th>';

		foreach ($desavanja as $desavanje)
		{
			$desavanjaTabela .= '<tr><td>' . $desavanje['ime'] . '</td><td>' . $desavanje['prezime'] . '</td><td>' . $desavanje['opis'] . '</td><td>' . $desavanje['naziv'] . '</td><td>' . $desavanje['tekst'] . '</td><td><a href="desavanje.php?id=' . $desavanje['id'] . '">' . $desavanje['naslov'] . '</a></td><td>' . $desavanje['tag'] . '</td><td>' . $desavanje['datum'] . '</td><td>' . $desavanje['cenaUlaznice'] . '</td><td>' . $desavanje['brKarata'] . '</td><td>' . $desavanje['grad'] . '</td></tr>';
		}

		$desavanjaTabela .= '</table>';
	}
	else
	{
		echo '<p style="font-weight:bold;color:red">Ne postoji dešavanje slično unesenom upitu.</p>';
	}

	print $desavanjaTabela;
?>

</table>
<div style="text-align: center"><br>

<div class="grupa">		
<form>	
<h2  class="naslov"style="font-family:arial;color:blue;"><p>Unesite Grupu:</p></h2>

<?php
	$opcijeGrupe = '<select onchange="window.location = \'?grupa=\' + this.value;">';
	$grupe = CitaGrupe();
	$opcijeGrupe .= '<option>Izaberite</option>';
	foreach ($grupe as $grupa)
	{
		$opcijeGrupe .= '<option value="' . $grupa['id'] . '">' . $grupa['naziv'] . '</option>';
	}
	$opcijeGrupe .= '</select>';
	print $opcijeGrupe;
?>

</form>		
</div>
<br>

<?php
	if (isset($_GET['grupa'])){
?>

<div class="podgrupa">		
<form>	
<h2  class="naslov"style="font-family:arial;color:blue;"><p>Unesite PodGrupu:</p></h2>

<?php 
		$opcijePodGrupe = '<select onchange="window.location=\'?grupa='.$_GET['grupa'].'&podgrupa=\'+this.value;">';
		$podgrupe = citaPodGrupe($_GET['grupa']);
		$opcijePodGrupe.='<option>Izaberite</option>';
		foreach ($podgrupe as $grupa)
		{
			$opcijePodGrupe.='<option value="'.$grupa['id'].'">'.$grupa['naziv'].'</option>';
		}
		$opcijePodGrupe.='</select>';
		print  $opcijePodGrupe;
	}
?>

</form>		
</div>
<br>

</body>
</html>