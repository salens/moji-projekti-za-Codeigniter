

<?php
class Prijatelj
{
  private $ime;
  private $prezime;
  private $godina;
  private static $odg = "Svi mi staticki volimo fax!";
  
  private $Negovoime;
  private $Negovosprezime;
  private $Negovogodina;
  
  const Nepromenjiva = "Ovo se nikada nece promeniti!";
  
	
	public function __construct($Negovoime=null,$Negovoprezime=null,$Negovogodina=null)
	{
		$this->NjegovoIme = $Negovoime;                
		$this->Njegovoprezime = $Negovoprezime;
		$this->Njegovrodjen	 = $Negovogodina; 	
	}
	
	  public function getInfo() 
	{
        echo "Moj Prijatelj ".$this->NjegovoIme."".$this->Njegovoprezime." je rodjen ".$this->Njegovrodjen."</br>";
    }
  
  
	public function josPrijatelja($ime, $prezime,$godina)  
	{
    $this->ime = $ime;                
    $this->prezime = $prezime;
	$this->godine = $godina;  
		
	}	
	
	public function josJedanPrijatelj($ime, $prezime,$godina)  
	{
    $this->ime = $ime;                
    $this->prezime = $prezime;
	$this->godine = $godina;  
		
	}	
	
	public function __toString()
	{
	
    return "Ime='$this->ime', Prezime='$this->prezime', Godiste='$this->godine'";
	}
  
	public static function Odgovor1()
	{
	echo "Oni obozavaju fax!";
	
		$odg ="Pokusaj ,menjanja!";

	echo self::$odg;
	}
   
    public static function Odgovor2()
	{
	echo "Oni onako obozavaju fax!";
	
	
	}
   
    public static function Odgovor3()
	{
	echo "Oni mrze fax!";
	}   
   
  

	function drustvo($marko,$zarko,$mirko)
	{
	$mirko = "Bane";
	return "<br>".$marko." , ".$zarko. " i " .$mirko. " 'Ovo je Konstanta' --> ". self::Nepromenjiva ;
	
        
	}
}

	
?>


