<?php
	session_start();
	require_once('funkcije.php');
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
	<li class="active"><a href="index.php">Pocetna</a></li>
	<li><a href="prijava.php">Prijava</a></li>
	<li><a href="registracija.php">Registracija</a></li>
	<li><a href="desavanja.php">Desavanja</a></li>
	<li><a href="profil.php">Profil</a></li>
</ul>
<div class="clear-both">&nbsp;</div>
</div>
<div class="centar">
<img src="css\centar.jpg" height="500" width="750">
</div>

</body>
</html>

