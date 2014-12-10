<?php

class Konekcija extends PDO { 

	private $endzin = NULL; 
	private $host = NULL; 
	private $baza = NULL; 
	private $user = NULL; 
	private $pass = NULL; 
	
	public function __construct(){ 
		$this->endzin = 'mysql'; 
		$this->host = '127.0.0.1'; 
		$this->baza = 'lex'; 
		$this->user = 'root'; 
		$this->pass = ''; 
		$dns = $this->endzin.':dbname='.$this->baza.";charset=utf8;host=".$this->host; 
		parent::__construct( $dns, $this->user, $this->pass,array(PDO::ATTR_PERSISTENT => true)); 
	}
}

?>