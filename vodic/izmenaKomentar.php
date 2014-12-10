<?php
	$link            = mysql_connect('localhost', 'root', '');
	$bazaSelektovana = mysql_select_db('vodic', $link);
	if (isset($_POST['kombtn']))
	{
		$upit = "UPDATE komentar SET tekst ='" . $_POST['komentar'] . "' WHERE id = " . $_POST['id'];
		mysql_query($upit);
		$header = 'Location: desavanje.php?id=' . $_POST['desavanje'];
		header($header);
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

<h1 style="color:red;">Izmenite komentar:</h1>
<form action="#" method="post">
	<textarea name="komentar" id="komentar" cols="150" rows="10"></textarea>
	<input type="hidden" name="id" value="<?php echo ($_POST['id']); ?>" />
	<input type="hidden" name="desavanje" value="<?php echo ($_POST['desavanje']); ?>" />
	<input type="submit" class="button" name="kombtn" value="Izmeni">
</form>

</body>
</html>