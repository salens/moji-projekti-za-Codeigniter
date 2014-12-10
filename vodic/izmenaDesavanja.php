<?php
	session_start();
	require_once('funkcije.php');
	$link            = mysql_connect('localhost', 'root', '');
	$bazaSelektovana = mysql_select_db('vodic', $link);
	if (isset($_POST['izmeni']))
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
			izmeniDesavanje($podaci, $_POST['id']);
			header("Location: profil.php");
		}
		else
		{
			echo ("Molimo vas da popunite obavezna polja.");
		}
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

<h1 style="color:red;">Izmenite desavanje:</h1>
<form action="#" method="post">
<input type="hidden" name="id" value="<?php print($_GET['id']); ?>" />
	<table class="tablestil">
	<tr>
    <td>Grupa:</td>
    <td><select style="margin-left:15px;" name="grupa" id="grupa">
    	<?php
    		$grupe = CitaGrupe();
    		foreach ($grupe as $grupa) {
    			echo ('<option value="'.$grupa['id'].'">'.$grupa['naziv'].'</option>');
    		}
    		$grupa = citaSvePodGrupe();
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
    <td><select style="margin-left:15px;" name="lokacija" id="lokacija">
		<?php
			$link = mysql_connect('localhost', 'root', '');
			$bazaSelektovana = mysql_select_db('vodic', $link);
			$upit = "SELECT id, naziv FROM lokacija";
			$rezultat = mysql_query($upit);
			while ($row = mysql_fetch_assoc($rezultat))
			{
				echo ('<option value="' . $row['id'] . '">' . $row['naziv'] . '</option>');
			}
		?>
    </select></td>
  </tr>
    <tr>
	    <td>Datum i vreme:</td>
	    <td style="width:350px;">
	    <select style="margin-left:15px;" name="godina" id="godina">
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
	    </select>
		<select id="mesec" name="mesec">
			<option value="1">January</option>
			<option value="2">February</option>
			<option value="3">March</option>
			<option value="4">April</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">July</option>
			<option value="8">August</option>
			<option value="9">September</option>
			<option value="10">October</option>
			<option value="11">Nobember</option>
			<option value="12">December</option>
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
	    <td><input name="izmeni" type="submit" value="Izmeni" /></td>
	  </tr>
  </table>
</form>
</body>
</html>