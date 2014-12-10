<?php
require_once('_php/require.php');
session_start();

if(isset($_POST['loguj']))
{
	$logovanje = new Logovanje;
	$radnik = new Radnik;
	$korIme = $logovanje->korIme;
	$radnikMetode = new RadnikMetode;
	$radnik = $radnikMetode->citaPodatke();

	$_SESSION['nivo'] = $radnik->nivo;
	$_SESSION['ime'] = $radnik->ime;
	$_SESSION['prezime'] = $radnik->prezime;
	$_SESSION['id'] = $radnik->id;

	$logovanje->loguj($_POST['korIme'],$_POST['pass']);

}

?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->


<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>LEX</title>

	<link rel='stylesheet' href='css/foundation.css' />
	<link rel='stylesheet' href='css/normalize.css' /> 

	<script src='js/vendor/custom.modernizr.js'></script>

</head>
<body>
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<div class="row">
		<div class="large-4 large-offset-4 centered">
			<div class="panel" style="overflow:auto;">
				<form method="post" action="#">
					<input type="text" placeholder="Korisničko ime" name="korIme"/>
					<input type="password" placeholder="Šifra" name="pass"/>
					<button type="submit" name="loguj" class="small button right">Uloguj se</button>
				</form>
			</div>
		</div>
	</div>
	<script>
	document.write('<script src=' +
		('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
		'.js><\/script>')
	</script>

	<script src="js/foundation.min.js"></script>
	<script src="js/foundation/foundation.placeholder.js"></script>
  <!--
  
  <script src="js/foundation/foundation.js"></script>
  
  <script src="js/foundation/foundation.dropdown.js"></script>
  
  <script src="js/foundation/foundation.placeholder.js"></script>
  
  <script src="js/foundation/foundation.forms.js"></script>
  
  <script src="js/foundation/foundation.alerts.js"></script>
  
  <script src="js/foundation/foundation.reveal.js"></script>
  
  <script src="js/foundation/foundation.tooltips.js"></script>
  
  <script src="js/foundation/foundation.section.js"></script>
  
  <script src="js/foundation/foundation.topbar.js"></script>
  
-->

<script>
$(document).foundation();
</script>
</body>
</html>
