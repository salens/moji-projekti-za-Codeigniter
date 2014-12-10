<?php
////////////////////////////////////////////////////////////////////////////////////////
// Klasa: DbKonektor
// Svrha: Konekcija na bazu
///////////////////////////////////////////////////////////////////////////////////////
require_once('SistemPromenljive.php');

class DbKonektor extends mysqli {
	private $upit;
	private $link;
	
	public function __construct() {
		//učitavanje parametara za pristup
        $sistemskep = SistemPromenljive::getSistemProm();

        $host = $sistemskep['dbhost'];
        $baza = $sistemskep['dbime'];
        $korisnik = $sistemskep['dbkorisnik'];
        $lozinka = $sistemskep['dblozinka'];
		
		//konekcija na bazu
        $this->link = mysqli_connect($host, $korisnik, $lozinka, $baza);
		
		//zatvaranje konekcije prilikom završetka skipta
		register_shutdown_function(array(&$this, 'zatvori'));
		
		//postavljanje kodnog rasporeda na serverskoj strani
		mysqli_set_charset($this->link, 'utf8');
		
		//podrazumevana baza
		mysqli_query($this->link, "USE $baza");
	}
	
	//test metoda(ne koristi se u verziji klase za realne projekte) za proveru linka
	public function getLink() {
		return $this->link;
	}
	
	/**
	* Izvršavanje upita
	* 
	* @param String $upit
	* 
	* @return mixed
	*/
	public function upit($upit) {
		$this->upit = $upit;
		$result = mysqli_query($this->link, $upit);

        return $result;
	}
	
	/**
	* Uzimanje result seta kao niza
	* 
	* @param mysqli_result $rezultat
	* 
	* @return mixed
	*/
    public function fetchArray($rezultat) {
		return mysqli_fetch_array($rezultat);
	}
	
	/**
	* Uzimanje result seta kao asocijativnog niza
	* 
	* @param mysqli_result $rezultat
	* 
	* @return mixed
	*/
    public function fetchAssoc($rezultat) {
		return mysqli_fetch_assoc($rezultat);
	}
	
	/**
	* Uzimanje result seta kao objekta
	* 
	* @param mysqli_result $rezultat
	* 
	* @return mixed
	*/
	public function fetchObject($rezultat) {
		return mysqli_fetch_object($rezultat);
	}
	
	/**
	* Vraćanje zadnjeg izvršenog upita
	* 
	* @return String
	*/
	public function getUpit() {
		return $this->upit;
	}
	
	/**
	* Vraćanje broja slogova result seta
	* 
	* @param mysqli_result $rezultat
	* 
	* @return int
	*/
	public function getNumRows($rezultat) {
		$result = mysqli_num_rows($rezultat);
        return $result;
	}
	
	/**
	* Vraćanje broja kolona result seta - polja tabele
	* 
	* @param mysqli_result $rezultat
	* 
	* @return int
	*/
	public function getNumFields($rezultat) {
		$result = mysqli_num_fields($rezultat);
        return $result;
	}

	/**
	* Vraćanje vrednosti 'polja' iz zadnjeg sloga 'tabele' sa identifikatorom 'id' 
	*           (ukoliko se ne navede 'id' ima istu vrednost kao 'polje')
	* 
	* @param String $tabela
	* 
	* @param String $polje
	* 
	* @param String $id
	* 
	* @return mixed
	*/
	public function getPoslednji($tabela, $polje, $id=NULL) {
		if( $id == NULL )
			$aincID = $polje;
		else 	
			$aincID = $id;
		$upit = "SELECT $polje FROM $tabela ORDER BY $aincID DESC LIMIT 1";
		$rezultat = $this->upit($upit);
		$row = $this->fetchObject($rezultat); 
		$zadnji = $row->$polje;
		$this->oslobodiResurse($rezultat);
		return $zadnji;
	}
	
	/**
	* Oslobađanje resursa
	* 
	* @param mysqli_result $rezultat
	* 
	* @return void
	*/
	public function oslobodiResurse($rezultat) {
		mysqli_free_result($rezultat);
	}
	
	/**
	* Zatvaranje konekcije
	* 
	* @return Bool
	*/
    public function zatvori() {
		if($this->link != NULL)
			mysqli_close($this->link);
		$this->link = NULL;
	}
}
?>