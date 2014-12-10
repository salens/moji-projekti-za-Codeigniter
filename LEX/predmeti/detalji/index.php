<?php
require_once('../../_php/require.php');
session_start();


if(isset($_SESSION['id']))
{
  $predmet = new Predmet;
  $predmetMetode = new predmetMetode;
  if (isset($_GET['id']))
  {

    $predmeti = $predmetMetode->citaSvePredmete($_GET['id'],NULL);

    if(isset($_POST['dugmeIzmeni']))
    {
      $_SESSION['predmet'] = $predmeti[0];
      header("Location: http://lapstarr/lex/predmeti/izmeni/?id=".$_GET['id']);
    }

    if (is_array($predmeti))
    {
      $heder="<!DOCTYPE html>
      <!--[if IE 8]>         <html class='no-js lt-ie9' lang='en' > <![endif]-->
      <!--[if gt IE 8]><!--> <html class='no-js' lang='en' > <!--<![endif]-->

      <head>
      <meta charset='utf-8' />
      <meta name='viewport' content='width=device-width' />
      <title>Pretraga predmeta -- LEX</title>

      <link rel='stylesheet' href='../../css/foundation.css' />
      <link rel='stylesheet' href='../../css/normalize.css' />

      <script type='text/javascript' >
      function potvrdi(predmetId) 
      {
        var odgovor = confirm ('Ovu akciju nije moguće poništiti. Da li ste sigurni da želite da želite da obrišete ovaj predmet?')
        if (odgovor)
        {
          window.location.href = '../obrisi/index.php?id='+predmetId;
        }
      }
      </script>

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

      $predmetiSadrzaj = "
      <div class='row'>
      <div class = 'large-6 columns'>
      <form method='post' action='#'>
      <p><strong>Tužilac:</strong><span id='detaljiIme'> ".$predmeti[0]->ime. " ".$predmeti[0]->prezime."</span></p>
      <p><strong>Broj predmeta:</strong><span id='detaljiIme'> ".$predmeti[0]->brojPredmeta. "</span></p>
      <p><strong>Sudski broj:</strong><span id='detaljiIme'> ".$predmeti[0]->sudskiBroj. "</span></p>
      <p><strong>Vrsta postupka:</strong><span id='detaljiIme'> ".$predmeti[0]->vrstaPostupka. "</span></p>
      <p><strong>Vrednost postupka:</strong><span id='detaljiIme'> ".$predmeti[0]->vrednost. " dinara</span></p>
      </div>
      <div class = 'large-6 columns'>
      <p><strong>Tuženi:</strong><span id='detaljiIme'></span></p>
      <p><strong>Sud:</strong><span id='detaljiIme'> ".$predmeti[0]->sud. "</span></p> 
      <p><strong>Datum podnošenja tužbe:</strong><span id='detaljiIme'> ".$predmeti[0]->datumVreme. "</span></p>
      <p><strong>Datum i vreme rasprave:</strong><span id='detaljiIme'> ".$predmeti[0]->datumRasprava. "</span></p>
      <p><strong>Fizička lokacija dosijea:</strong><span id='detaljiIme'> ".$predmeti[0]->lokacija. "</span></p>
      </div>
      </div>
      <div class='row'>
      <div class='large-4 large-offset-4 centered'>
      <button class='medium success button' name='dugmeIzmeni' id='dugmeIzmeni' type='submit'>Izmeni</button>
      <a href='javascript:potvrdi(\"".$_GET['id']."\")' class='medium alert button right' name='dugmeOtkazi' type='reset'>Obriši</a>
      </form>
      </div></div>";
      
      $dole = "<script src='../../js/foundation.min.js'></script>
      <script src='../../js/foundation/foundation.placeholder.js'></script>
      <script src='../../js/vendor/jquery.js'></script>
      <script>
      document.write('<script src=' +
        ('__proto__' in {} ? '../../js/vendor/zepto' : '../../js/vendor/jquery') +
        '.js><\/script>')
</script>
<script src='../../js/foundation/foundation.js'></script>

<script src='../../js/foundation/foundation.placeholder.js'></script>

<script src='../../js/foundation/foundation.topbar.js'></script>

</body>
</html>";
print $heder.$predmetiSadrzaj.$dole;
}
else
{
  print 'Ne postoji predmet sa tim IDjem';
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






























