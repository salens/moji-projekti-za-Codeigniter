<?php
	SESSION_start();
	require_once('funkcije.php');
	$email  = '';
	$poruka = '';
	if (isset($_POST['btnPrijava']))
	{
		$email   = trim($_POST['txtEmail']);
		$lozinka = trim($_POST['txtLozinka']);
		if (!empty($email) && !empty($lozinka))
		{
			$rezultatPrijave = prijava($email, $lozinka);
			if (is_array($rezultatPrijave))
			{
				$_SESSION['Korisnik'] = $rezultatPrijave;
				header('Location: index.php');
			}
			else
			{
				$poruka = $rezultatPrijave;
			}
		}
		else
		{
			$poruka = 'Molimo vas da upišete vašu email adresu i lozinku.';
		}
	}
?>
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
		header('Location: index.php');
	}
?>
</div>

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

<h1 style="color:red;font-size:50px;text-align: center">Dobrodosli na sajt vodic.com</h1>
<div id="main-nav">
<ul>
	<li ><a href="index.php">Pocetna</a></li>
	<li class="active"><a href="prijava.php">Prijava</a></li>
	<li><a href="registracija.php">Registracija</a></li>
	<li><a href="desavanja.php">Desavanja</a></li>
	<li><a href="profil.php">Profil</a></li>
</ul>
</div>
<?php
	if (!isset($_SESSION['Korisnik'])) {
?>
<div id="prijava" style="text-align: center">
<p class="greska"><?php echo($poruka); ?></p>
<form name="prijava" action="#" method="post">
	<table class="tablestil">
		<tr>
			<td>Email:</td>
			<td><input type="text" name="txtEmail" size="25" value="<?php echo($email); ?>" /></td>
		</tr>
		<tr>
			<td>Lozinka:</td>
			<td><input type="password" name="txtLozinka" size="25" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input class="active" type="submit" name="btnPrijava" value="Prijavi se" /></td>
		</tr>
	</table>
</form>
</div>
<?php
	}
?>
</body>
</html>