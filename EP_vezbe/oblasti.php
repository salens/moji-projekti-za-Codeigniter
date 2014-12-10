<?php
	require_once('includes/DbKonektor.php');
	
	$konektor = new DbKonektor();

	
	$upit = "SELECT naziv, oblastID FROM oblast ORDER BY oblastID";
	$res = $konektor->upit($upit);
	
	echo "OBLASTI:"."<br/><br/>";
	while( $row = $konektor->fetchObject($res) )
		echo $row->oblastID." : ".$row->naziv."<br/>";
	echo "<br/>";
		
	echo "Broj oblasti : ".$konektor->getNumRows($res)."<br/>";
	echo "Broj polja resultSeta : ".$konektor->getNumFields($res)."<br/>";
	echo "Izvršeni upit : <i>".$konektor->getUpit()."</i>";
	
	echo "<br/><hr/><br/>";	
	
	
	
	$upit = "SELECT naziv, oblastID FROM oblast WHERE naziv LIKE 'Zašti%' ORDER BY oblastID";
	$res = $konektor->upit($upit);
	
	echo "ZAŠTITE:"."<br/><br/>";
	//pristupanje slogovima resultSet preko asocijativnog niza
	while( $row = $konektor->fetchAssoc($res) )
		echo $row['oblastID']." : ".$row['naziv']."<br/>";
	echo "<br/>";
	
	echo "Broj zaštita : ".$konektor->getNumRows($res)."<br/>";
	echo "Broj polja resultSeta : ".$konektor->getNumFields($res)."<br/>";
	echo "Izvršeni upit : <i>".$konektor->getUpit()."</i>";
	
	echo "<br/><hr/><br/>";	
		
		
		
	$upit = "SELECT naziv, oblastID, logo FROM oblast";
	$res = $konektor->upit($upit);	
	
	echo "Broj polja tabele 'oblast' : ".$konektor->getNumFields($res)."<br/>";
	echo "Poslednji ID : ".$konektor->getPoslednji("oblast", "oblastID")."<br/>";
	echo "Naziv poslednje unete oblasti : ".$konektor->getPoslednji("oblast", "naziv", "oblastID")."<br/><br/>";
	
	//primer korišćenja funkcije 'print_r' 
	echo "<b>Link u slučaju mysqli je objekat</b>:<br/>".print_r($konektor->getLink(), true)."<br/><br/>";
	
	
	$konektor->oslobodiResurse($res);
	$konektor->zatvori();
	
	
	//mysql pristup
	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("km");
	//primer korišćenja funkcije 'print_r' 
	echo ",<b>za razliku od mysql kod koga je link resurs</b>:<br/>".print_r($link, true)."<br/><br/><br/>";
	mysql_close();
?>