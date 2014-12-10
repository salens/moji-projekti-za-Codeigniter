<?php
require_once('../../_php/require.php');
session_start();

if(isset($_SESSION['id']))
{
  $predmet = new Predmet;
  $predmetMetode = new predmetMetode;
  if (isset($_GET['id']))
  {

    $obrisano = $predmetMetode->obrisiPredmet($_GET['id']);

    if($obrisano != true)
    {
      print '<script type="text/javascript">
      alert ("Predmet je obrisan")
      window.location.href="../../predmeti/"
      </script>';
    }
    else
    {
      print '<script type="text/javascript">
      alert ("Ne postoji predmet sa tim IDjem")              
      window.location.href="../../predmeti/"
      </script>';
    }
  }


}

else 
{
  print '<script type="text/javascript">alert("Logovanje je obavezno");
  window.location.href="../../";</script>';
  header("Location: ../../");
}

?>






























