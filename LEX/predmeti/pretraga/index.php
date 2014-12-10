<?php
require_once('../../_php/require.php');
session_start();

if(isset($_SESSION['id']))
{
	$validacija = new Validacija;
	$validacijaMetode = new ValidacijaMetode;

	if(isset($_POST['dugmePretraga']))
	{
		unset($_POST['dugmePretraga']);

		$validacija = $validacijaMetode->validiraj($_POST,'pretraga');		
	}

	$heder="<!DOCTYPE html>
	<!--[if IE 8]>         <html class='no-js lt-ie9' lang='en' > <![endif]-->
	<!--[if gt IE 8]><!--> <html class='no-js' lang='en' > <!--<![endif]-->

	<head>
	<meta charset='utf-8' />
	<meta name='viewport' content='width=device-width' />
	<title>Pretraga predmeta -- LEX</title>

	<link rel='stylesheet' href='../../css/foundation.css' />
	<link rel='stylesheet' href='../../css/normalize.css' />

	<script src='../../js/vendor/custom.modernizr.js'></script></head>
	<body>
	<nav class='top-bar'>
	<ul class='title-area'>
	<!-- Title Area -->
	<li class='name'>
	<h1><a href='/lex/'>LEX</a></h1>
	</li>
	<!-- Remove the class 'menu-icon' to get rid of menu icon. Take out 'Menu' to just have icon alone -->
	<li class='toggle-topbar menu-icon'><a href='#'><span>Menu</span></a></li>
	</ul>

	<section class='top-bar-section'>
	<!-- Left Nav Section -->
	<ul class='left'>
	<li class='divider'></li>
	<li class='has-dropdown active'><a href='#'>Predmeti</a>
	<ul class='dropdown'>
	<li><a href='../dodaj/'>Dodaj predmet</a></li>
	<li><a href='../'>Svi predmeti</a></li>
	<li><a href='../moji/'>Moji predmeti</a></li>
	<li><a href='../pretraga/'>Pretraga</a></li>
	<li class='divider'></li>
	</ul>
	</li>
	<li class='divider'></li>
	<li class='has-dropdown'><a href='#'>Stranke</a>
	<ul class='dropdown'>

	<li><a href='../../stranke/dodaj/'>Dodaj stranku</a></li>
	<li><a href='../../stranke/'>Sve stranke</a></li>
	<li><a href='../../stranke/pretraga/'>Pretraga</a></li>
	<li class='divider'></li>
	</ul>
	</li>
	<li class='divider'></li>
	<li class='has-dropdown'><a href='#'>Obaveze</a>
	<ul class='dropdown'>

	<li><a href='../'>Dodaj obavezu</a></li>
	<li><a href='../moji/'>Sve obaveze</a></li>
	<li><a href='../moji/'>Današnje</a></li>
	<li class='has-dropdown'><a href='#'>Pretraga</a>
	<ul class='dropdown'>
	<li><a href='#'>Po datumu</a></li>
	</ul>
	</li>
	<li class='divider'></li>
	</ul>
	<li class='divider'></li>
	</li>
	</ul>

	<!-- Right Nav Section -->
	<ul class='right'>
	<li class='divider hide-for-small'></li>
	<li class='has-dropdown'><a href='#'>Main Item 4</a>

	<ul class='dropdown'>
	<li><label>Dropdown Level 1 Label</label></li>
	<li class='has-dropdown'><a href='#' class=''>Dropdown Level 1a</a>

	<ul class='dropdown'>
	<li><a href='#'>Dropdown Level 2a</a></li>
	<li><a href='#'>Dropdown Level 2b</a></li>
	<li class='has-dropdown'><a href='#'>Dropdown Level 2c</a>

	<ul class='dropdown'>
	<li><a href='#'>Dropdown Level 3a</a></li>
	<li><a href='#'>Dropdown Level 3b</a></li>
	<li><a href='#'>Dropdown Level 3c</a></li>
	</ul>
	</li>
	<li><a href='#'>Dropdown Level 2d</a></li>
	<li><a href='#'>Dropdown Level 2e</a></li>
	<li><a href='#'>Dropdown Level 2f</a></li>
	</ul>
	</li>
	<li><a href='#'>Dropdown Level 1b</a></li>
	<li><a href='#'>Dropdown Level 1c</a></li>
	<li class='divider'></li>
	<li><label>Dropdown Level 1 Label</label></li>
	<li><a href='#'>Dropdown Level 1d</a></li>
	<li><a href='#'>Dropdown Level 1e</a></li>
	<li><a href='#'>Dropdown Level 1f</a></li>
	<li class='divider'></li>
	<li><a href='#'>See all &rarr;</a></li>
	</ul>
	</li>
	<li class='divider show-for-small'></li>
	<li class='has-form'>
	<a href='../../odjava/' name='odjava'>Odjavi se [ " . $_SESSION["ime"] .' '.$_SESSION["prezime"] . " ]</a>
	</li>
	</ul>
	</section>
	</nav>";
	
	$sadrzaj = "<div class='row'>

	<div class='large-6 columns large-offset-3'>
	<p><strong>Pretraga predmeta:</strong></p>
	<form method='post' action='#'>
	<label>Parametar</label>
	<select name='parametar'>
	<option value='brojPredmeta'>1 - Broj predmeta</option>
	<option value='sudskiBroj'>2 - Sudski broj</option>
	<option value='prezime'>3 - Prezime</option>
	</select><br /><br />
	<label>Tražena vrednost</label>
	<input type='text' name='vrednost' class='required' minlength='1' placeholder='prezime, broj predmeta ili sudski broj predmeta' size='25' maxlength='25' />
	<div class='large-2 columns large-offset-4'>
	<button class='medium success button' id='dugmePretraga' name='dugmePretraga' disabled='disabled'>Traži</button></form>
	</div>
	</div>
	</div>";

	$predmetiSadrzaj = "<div class='row'>

	<div class='large-10 small-centered small-offset-2'>
	";

	$br = 0;

	if(is_array($validacija) and count($validacija) != 0)
	{
		$predmetiSadrzaj .= "<table>
	<tr><td><strong>Rb.</strong></td><td><strong>Ime</strong></td><td><strong>Prezime</strong></td><td><strong>Broj</strong></td><td><strong>Sudski broj</strong></td><td><strong>Datum tužbe</strong></td><td><strong>Status</strong></td><td colspan='4'><strong>Zadužen</strong></td></tr>";
		foreach ($validacija as $rezultat)
		{

			$br +=1;
			$predmetiSadrzaj .= '<tr><td>'.$br.'.</td><td>'. ucfirst($rezultat['ime']) .'</td><td>'. ucfirst($rezultat['prezime']) .'</td><td>'. strtoupper($rezultat['brojPredmeta']) .'</td><td>'. strtoupper($rezultat['sudskiBroj']) .'</td><td>'. date('d.m.Y.', strtotime($rezultat['datumVreme'])) .'</td><td>'. ucfirst($rezultat['status']) .'</td><td>'. ucfirst($rezultat['imeR']) .' ' . ucfirst($rezultat['prezimeR']).'</td><td><input name"hidId'. $rezultat['id'] .'" type="hidden" value="'. $rezultat['id'] .'"/></td><td><a href="./detalji/" class="">Detalji</a></td><td><a href="./obaveze/" class="">Obaveze</a></td></tr>';
		}
		$predmetiSadrzaj.="</table></div></div>";
	}
	elseif ((is_array($validacija) and count($validacija) == 0)){

		$predmetiSadrzaj .= "<div class='small-6 small-offset-2 columns'><p><strong>Ne postoji predmet sa unetim podacima</strong></p></div>";
	}
	


	$dole = "<script src='../../js/foundation.min.js'></script>
	<script src='../../js/foundation/foundation.placeholder.js'></script>
	<script src='../../js/vendor/jquery.js'></script>
	<script src='../../js/vendor/jquery.validate.js'></script>
	<script src='../../js/vendor/messages_sr.js'></script>
	<script>
	document.write('<script src=' +
		('__proto__' in {} ? '../../js/vendor/zepto' : '../../js/vendor/jquery') +
		'.js><\/script>')
</script>
<script src='../../js/foundation/foundation.js'></script>

<script src='../../js/foundation/foundation.placeholder.js'></script>

<script src='../../js/foundation/foundation.topbar.js'></script>
<script>
	$(document).ready(function() {

		$('form').keyup(function () {
			if ($('form').valid() == false ) {
			$('#dugmePretraga').attr('disabled', true);
		}
		else {
			$('#dugmePretraga').attr('disabled', false);
		}
		});

	});
</script>

</body>
</html>";

print $heder.$sadrzaj.$predmetiSadrzaj.$dole;


}
else 
{ 

	print '<script type="text/javascript">alert("Logovanje je obavezno");
	window.location.href="../../";</script>';
  	header("Location: ../../");
}

?>