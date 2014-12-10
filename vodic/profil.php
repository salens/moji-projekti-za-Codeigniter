<?php
	session_start();
	require_once 'funkcije.php';
	$link = mysql_connect('localhost', 'root', '');
	$bazaSelektovana = mysql_select_db('vodic', $link);
	if (isset($_SESSION['Korisnik']['id']))
	{
		$idKorisnik = $_SESSION['Korisnik']['id'];
		$poruka = '';
		if (isset($_POST['btnIzmeni']))
		{
			$novalozinka    = trim($_POST['txtNewPass1']);
			$potvrdalozinka = ($_POST['txtNewPass2']);
			if (!empty($novalozinka))
			{
				if ($novalozinka != $potvrdalozinka)
				{
					$poruka = '<p>Lozinke se ne poklapaju.</p>';
				}
				else
				{
					$rez = izmeniSifru($novalozinka, $idKorisnik);
					echo ('Uspesno ste promenuli sifru!');
				}
			}
			else
			{
				$poruka = '<p>Molimo vas da upisete obavezne podatke.</p>';
			}
		}
		else if (isset($_POST['podaciBtn']))
		{
			$podaci = array(
				'ime' => trim($_POST['ime']),
				'prezime' => trim($_POST['prezime']),
				'email' => trim($_POST['email']),
				'telefon' => trim($_POST['telefon']),
				'drzava' => trim($_POST['drzava']),
				'adresa' => trim($_POST['adresa']),
				'grad' => trim($_POST['grad']),
				'facebook' => trim($_POST['facebook']),
				'twiter' => trim($_POST['twitter']),
				'linkedin' => trim($_POST['linkedin']),
				'google' => trim($_POST['google'])
			);
			$poruka = izmenaPodataka($podaci);
			if (!$poruka)
				$poruka = "Doslo je do greske.<br/>";
			else
			{
				$link = mysql_connect('localhost', 'root', '');
				$bazaSelektovana = mysql_select_db('vodic', $link);
				$poruka  = "Uspesno ste izmenili podatke.<br/>";
				$upit = "SELECT * from korisnik WHERE id = " . $_SESSION['Korisnik']['id'];
				$rezultat  = mysql_query($upit);
				$_SESSION['Korisnik'] = mysql_fetch_assoc($rezultat);
			}
		}
		else if (isset($_POST['desavanjebtn']))
		{
			if (isset($_POST['naslov']) && isset($_POST['opis']) && isset($_POST['brojkarata']) && isset($_POST['cena']) && isset($_POST['tagovi']))
			{
				$datum  = "" . $_POST['godina'] . "-" . $_POST['mesec'] . "-" . $_POST['dan'] . " " . $_POST['sat'] . ":" . $_POST['minut'] . ":00";
				$podaci = array(
					'naslov' => trim($_POST['naslov']),
					'opis' => trim($_POST['opis']),
					'grupa' => trim($_POST['grupa']),
					'lokacija' => trim($_POST['lokacija']),
					'vreme' => $datum,
					'brojKarata' => trim($_POST['brojkarata']),
					'cena' => trim($_POST['cena']),
					'tagovi' => trim($_POST['tagovi'])
				);
				dodajDesavanje($podaci);
			}
			else
			{
				$poruka = "Molimo vas da popunite obavezne podatke.";
			}
		}
		else if (isset($_POST['brisanjedesavanja']))
		{
			$upit = "DELETE FROM desavanje WHERE id = " . $_POST['id'];
			mysql_query($upit);
			$poruka = "Uspesno ste obrisali desavanje!";
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

<h1 style="font-family:arial;color:red;font-size:50px;text-align: center">Dobrodosli na sajt vodic.com</h1>
<div id="main-nav">
	<ul>
		<li><a href="index.php">Pocetna</a></li>
		<li><a href="prijava.php">Prijava</a></li>
		<li><a href="registracija.php">Registracija</a></li>
		<li><a href="desavanja.php">Desavanja</a></li>
		<li class="active"><a href="profil.php">Profil</a></li>
	</ul>
<div class="clear-both">&nbsp;</div>
</div>
<div style="overflow:auto">
<div style="float:left;">

<?php
   if (isset($_SESSION['Korisnik']))
   {
      echo ($poruka);
?>

<h2 style="color:blue;">Podaci:</h2>

<?php
	$link = mysql_connect('localhost', 'root', '');
	$bazaSelektovana = mysql_select_db('vodic', $link);
	$upit = "SELECT * from korisnik WHERe id =" . $_SESSION['Korisnik']['id'];
	$rezultat = mysql_query($upit);
	$row = mysql_fetch_assoc($rezultat);
?>

<form action="#" class="tablestil" style="margin-left:5px;margin-right:10px;margin-top:5px;" method="post" name="podaci">
	<table>
  <tr>
    <td>Ime:</td>
    <td><input name="ime" type="text" size="30" value="<?php echo ($row['ime']); ?>" /></td>
  </tr>
  <tr>
    <td>Prezime</td>
    <td><input name="prezime" type="text" size="30" value="<?php echo ($row['prezime']); ?>" /></td>
  </tr>
    <tr>
    <td>Email:</td>
    <td><input name="email" type="text" size="30" value="<?php echo ($row['email']); ?>" /></td>
  </tr>
    <tr>
    <td>Adresa:</td>
    <td><input name="adresa" type="text" size="30" value="<?php
    if (isset($row['adresa']))
    {
    	echo ($row['adresa']);
    }
    ?>" /></td>
  </tr>
    <tr>
    <td>Grad:</td>
    <td><input name="grad" type="text" size="30" value="<?php
    if (isset($row['grad']))
    {
    	echo ($row['grad']);
    }
    ?>"/></td>
  </tr>
    <tr>
    <td>Drzava:</td>
    <td><input name="drzava" type="text" size="30" value="<?php
    if (isset($row['drzava']))
    {
    	echo ($row['drzava']);
    }
    ?>"/></td>
  </tr>
    <tr>
    <td>Telefon:</td>
    <td><input name="telefon" type="text" size="30" value="<?php
    if (isset($row['telefon']))
    {
    	echo ($row['telefon']);
    }
    ?>"/></td>
  </tr>
    <tr>
    <td>Linkedin:</td>
    <td><input name="linkedin" type="text" size="30" value="<?php
    if (isset($row['linkedin']))
    {
    	echo ($row['linkedin']);
    }
    ?>"/></td>
  </tr>
    <tr>
    <td>Google+:</td>
    <td><input name="google" type="text" size="30" value="<?php
    if (isset($row['google']))
    {
    	echo ($row['google']);
    }
    ?>"/></td>
  </tr>
    <tr>
    <td>Facebook:</td>
    <td><input name="facebook" type="text" size="30" value="<?php
    if (isset($row['facebook']))
    {
    	echo ($row['facebook']);
    }
    ?>"/></td>
  </tr>
      <tr>
    <td>Twitter:</td>
    <td><input name="twitter" type="text" size="30" value="<?php
    if (isset($row['twiter']))
    {
    	echo ($row['twiter']);
    }
    ?>"/></td>
  </tr>

<tr><td>&nbsp </td><td><input class="desno button" type="submit" name="podaciBtn" value="Izmeni"></td></tr>
</table>
</form>
<h2 style="color:blue;">Promena lozinke:</h2>
<form name="pass" action="#" method="post">
<table class="tablestil" style="margin:5px;">
  <tr>
    <td>Nova lozinka</td>
    <td><input name="txtNewPass1" type="password" size="30" /></td>
  </tr>
  <tr>
    <td>Ponovite novu lozinku</td>
    <td><input name="txtNewPass2" type="password" size="30" /></td>
  </tr>
<tr><td>&nbsp </td><td><input class="desno button" type="submit" name="btnIzmeni" value="Izmeni"></td></tr>
</table>
</form>

<?php
	}
	else
	{
		echo('<h2><b>'.'Molimo vas da se prijavite!'.'</b></h2>');
		echo('<a href="prijava.php">Prijava</a>');
		die;
	}				
?>

</div>
<div style="float:left;">
<div>
<h2 style="color:blue;">Vase rezervacije:</h2>

<?php
	$upit     = "SELECT Rezervise.kolicina, Rezervise.idIzbor, RezervacijaKarata.vreme FROM korisnik inner join RezervacijaKarata on korisnik.id = RezervacijaKarata.idKorisnik 
	inner join Rezervise ON Rezervise.idRezKarata = RezervacijaKarata.id WHERE korisnik.id = " . $_SESSION['Korisnik']['id'];
	$kolicine = array();
	$idovi = array();
	$vremena = array();
	$rezultat = mysql_query($upit);
	if (mysql_num_rows($rezultat) > 0)
	{
		while ($row = mysql_fetch_assoc($rezultat))
		{
			$kolicine[] = $row['kolicina'];
			$idovi[] = $row['idIzbor'];
			$vremena[] = $row['vreme'];
		}
		$upit = "SELECT * FROM izbor inner join desavanje on izbor.idDesavanje = desavanje.id WHERE izbor.id IN (";
		foreach ($idovi as $id)
		{
			$upit .= "" . $id . ",";
		}
		$upit = substr($upit, 0, strlen($upit) - 1);
		$upit .= ")";
		$rezultat = mysql_query($upit);
		while ($row = mysql_fetch_assoc($rezultat))
		{
			$nazivi[] = $row['naslov'];
		}
		echo ('<table border="1">');
		echo ('<th>Naziv</th><th>Vreme</th><th>Kolicina</th>');
		for ($i = 0; $i < count($idovi); $i++)
		{
			echo ('<tr>');
			echo ('<td>');
			echo ($nazivi[$i]);
			echo ('</td>');
			echo ('<td>');
			echo ($vremena[$i]);
			echo ('</td>');
			echo ('<td>');
			echo ($kolicine[$i]);
			echo ('</td>');
			echo ('</tr>');
		}
		echo ('</table>');
	}
	else
	{
		echo ('<p>Nemate rezervacija.</p>');
	}
?>

</div>

<?php
	if ($_SESSION['Korisnik']['tip'] == 1) {
?>

<div style="float:left;">
<h2 style="color:blue;">Vasa desavanja:</h2>

<?php
	$upit     = "SELECT id,naslov FROM desavanje WHERE idKorisnik = " . $_SESSION['Korisnik']['id'];
	$rezultat = mysql_query($upit);
	if ($rezultat && mysql_num_rows($rezultat) > 0)
	{
		echo ('<table id="tabledesavanja" border="1">');
		echo ('<th>Naziv</th><th>Brisanje</th>');
		while ($row = mysql_fetch_assoc($rezultat))
		{
			echo ('<tr>');
			echo ('<td>');
			echo ('<a href=izmenaDesavanja.php?id=' . $row['id'] . '>');
			echo ($row['naslov']);
			echo ('</a></td>');
			echo ('<td style="width:30px;text-align:center;">');
			echo ('<form action="#" style="width:25px;" method="post"><input type="hidden" name="id" value="' . $row['id'] . '" /><input type="submit" class="button" value="x" name="brisanjedesavanja" /></form>');
			echo ('</td>');
		}
		echo ('</table>');
	}
	else
	{
		echo ('<p>Nemate unetih desavanja.</p>');
	}
?>

</div>
</div>
<div style="float:left;margin-left:25px;	">
	<h2 style="color:blue;">Unesite novo desavanje:</h2>
	<form class="tablestil" action="#" method="post">
		<table>
			  <tr>
		    <td>Grupa:</td>
		    <td><select style="margin-left: 15px;" name="grupa" id="grupa">
		    	
		    	<?php
		    		$grupe = CitaGrupe();
		    		foreach ($grupe as $grupa) {
		    			echo ('<option value="'.$grupa['id'].'">'.$grupa['naziv'].'</option>');
		    		}
		    		$grupe = citaSvePodGrupe();
		    		foreach ($grupe as $grupa) {
		    			echo ('<option value="'.$grupa['id'].'">'.$grupa['naziv'].'</option>');
		    		}
		    	?>

		    </select></td>
		  </tr>
		  <tr>
		    <td>Naslov:</td>
		    <td><input name="naslov" type="text" size="30" /></td>
		  </tr>
		  <tr>
		    <td>Opis:</td>
		    <td><input name="opis" type="text" size="30" /></td>
		  </tr>
		    <tr>
		    <td>Lokacija:</td>
		    <td><select style="margin-left: 15px;" name="lokacija" id="lokacija">

		    	<?php
		    		$link            = mysql_connect('localhost', 'root', '');
					$bazaSelektovana = mysql_select_db('vodic', $link);
		    		$upit = "SELECT id, naziv FROM lokacija";
		    		$rezultat = mysql_query($upit);
		    		while ($row = mysql_fetch_assoc($rezultat))
		    		{
		    			echo ('<option value="'.$row['id'].'">'.$row['naziv'].'</option>');
		    		}
		    	?>

		    </select></td>
		  </tr>
		    <tr>
		    <td>Datum i vreme:</td>
		    <td style="width:350px;">
	    	<select style="margin-left: 15px;" name="godina" id="godina">
		    	<option value="2014">2014</option>
		    	<option value="2015">2015</option>
		    	<option value="2016">2016</option>
		    	<option value="2017">2017</option>
		    	<option value="2018">2018</option>
		    	<option value="2019">2019</option>
		    	<option value="2020">2020</option>
		    	<option value="2021">2021</option>
		    	<option value="2022">2022</option>
		    	<option value="2023">2023</option>
				<option value="2023">2024</option>
				<option value="2023">2025</option>
		    </select>
			<select id="mesec" name="mesec">
				<option value="1">Januar</option>
				<option value="2">Februar</option>
				<option value="3">Mart</option>
				<option value="4">April</option>
				<option value="5">Maj</option>
				<option value="6">Jun</option>
				<option value="7">Jul</option>
				<option value="8">Avgust</option>
				<option value="9">Septembar</option>
				<option value="10">Oktobar</option>
				<option value="11">Novembar</option>
				<option value="12">Decembar</option>
			</select>
			<select id="dan" name="dan">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>
			<select style="margin-left:20px;" name="sat" id="sat">
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
			</select>
			<select name="minut" id="minut">
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>	
			</select>
		  </tr>
		    <tr>
		    <td>Cena:</td>
		    <td><input name="cena" type="text" size="30" /></td>
		  </tr>
		    <tr>
		    <td>Broj karata:</td>
		    <td><input name="brojkarata" type="text" size="30" /></td>
		  </tr>
		    <tr>
		    <td>Tagovi:</td>
		    <td><input name="tagovi" type="text" size="30" /></td>
		  </tr>
		    <tr>
		    <td>&nbsp;</td>
		    <td><input name="desavanjebtn" type="submit" value="Dodaj" /></td>
		  </tr>
	  </table>
	</form>
</div>

<?php
	}
?>

</div>

</body>
</html>
