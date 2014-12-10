<?php
	session_start();
	require_once('funkcije.php');
	$poruka = '';
	if (ISSET($_POST['registracija']))
	{
		$ime = trim($_POST['ime']);
		$prezime = trim($_POST['prezime']);
		$email = trim($_POST['email']);
		$lozinka = trim($_POST['lozinka']);
		$potvrdalozinke = trim($_POST['lozinkapotvrda']);
		$drzava = trim($_POST['drzava']);
		$grad = trim($_POST['grad']);
		$adresa = trim($_POST['adresa']);
		$facebook = trim($_POST['facebook']);
		$twitter = trim($_POST['twitter']);
		$google = trim($_POST['googleplus']);
		$linkedin  = trim($_POST['linkedin']);
		$brtelefona = trim($_POST['brtel']);
		$tip = $_POST['tip'];
		if (!empty($ime) && !empty($prezime) && !empty($email) && !empty($lozinka))
		{
			if (strlen($email) < 8 || strpos($email, '@') < 2 || strpos($email, '.' < 5))
			{
				$poruka = "Uneta email adresa nije validna.";
			}
			else if ($lozinka != $potvrdalozinke)
			{
				$poruka = 'Potvrda lozinke ne odgovara unetoj lozinci.';
			}
			else
			{
				$rezultatRegistracije = registracija($tip, $ime, $prezime, $email, $lozinka, $brtelefona, $drzava, $adresa, $grad, $facebook, $twitter, $linkedin, $googleplus);
				if (!$rezultatRegistracije)
					$poruka = 'Uneta email adresa je vec registrovana.';
				else
					$poruka = 'Uspesno ste se registrovali.';
			}
		}
		else
		{
			$poruka = 'Molimo vas da upisete obavezne podatke.';
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
	<li><a href="prijava.php">Prijava</a></li>
	<li class="active"><a href="registracija.php">Registracija</a></li>
	<li><a href="desavanja.php">Desavanja</a></li>
	<li><a href="profil.php">Profil</a></li>
</ul>
<div class="clear-both">&nbsp;</div>
</div>
<?php
	if (!isset($_SESSION['Korisnik'])) {
?>
<div id="register">
<form action="#" method="post">
	<h2 style="color:blue;"><p>Za registraciju unesite vase podatke:</p></h2>
	<table class="tablestil">
		<tr>
			<td>*Ime:</td>
			<td><input type="text" name="ime" /></td>
		</tr>
		<tr>
			<td>*Prezime:</td>
			<td><input type="text" name="prezime" /></td>
		</tr>
		<tr>
			<td>*Lozinka:</td>
			<td><input type="password" name="lozinka" /></td>
		</tr>
		<tr>
			<td>*Potvrda lozinke:</td>
			<td><input type="password" name="lozinkapotvrda" /></td>
		</tr>
		<tr>
			<td>*E-mail adresa:</td>
			<td><input type="text" name="email" title="Unesite traženi podatak!" value="<?php if(isset($_POST['txtEmail'])){echo($_POST['txtEmail']);} ?>" /></td>
		</tr>
		<tr>
			<td>fotografija:</td>
			<td><input type="text" /></td>
		</tr><tr>
			<td>adresa:</td>
			<td><input type="text" name="adresa" /></td>
		</tr><tr>
			<td>grad:</td>
			<td><input type="text" name="grad" /></td>
		</tr>
		<tr>
			<td>drzava:</td>
			<td><input type="text" name="drzava" /></td>
		</tr>
		<tr>
			<td>telefon:</td>
			<td><input type="text" name="brtel" /></td>
		</tr>
		<tr>
			<td>linkedin:</td>
			<td><input type="text" name="linkedin" /></td>
		</tr>
		<tr>
			<td>google+:</td>
			<td><input type="text" name="googleplus" /></td>
		</tr>
		<tr>
			<td>facebook:</td>
			<td><input type="text" name="facebook" /></td>
		</tr>
		<tr>
			<td>twiter:</td>
			<td><input type="text" name="twitter" /></td>
		</tr>
		<tr>
			<td>Tip korisnika:</td>
			<td>Oglasavac:<input type="radio" name="tip" value="1" /><br/>
				Pregledac:<input type="radio" name="tip" value="0" checked="checked" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="registracija" value="Prosledi" /></td>
		</tr>
	</table>
</form>
<p id="greska"><?php echo($poruka);?></p>					
</div>
<?php
	}
?>
</body>
</html>