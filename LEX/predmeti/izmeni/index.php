<?php
require_once('../../_php/require.php');
session_start();

if(isset($_SESSION['predmet']))
{
  if (isset($_GET['id']))
  {
    $predmetMetode = new predmetMetode;
    $vrstePostupka = $predmetMetode->citaVrste();
    $radnikMetode = new RadnikMetode;
    $radnici = $radnikMetode->citaRadnike();
    $sudMetode = new SudMetode;
    $sudovi = $sudMetode->citaSudove();
    $statusi = $predmetMetode->citaStatuse();
    $strankaMetode = new StrankaMetode;
    $stranke = $strankaMetode->citaStranke();

    if (isset($_POST['dugmeIzmeni']))
    {

      unset($_POST['dugmeIzmeni']);
      $validacijaMetode = new ValidacijaMetode;
      $validacija = $validacijaMetode->validiraj($_POST,'izmena');

    }

    $heder="<!DOCTYPE html>
    <!--[if IE 8]>         <html class='no-js lt-ie9' lang='en' > <![endif]-->
    <!--[if gt IE 8]><!--> <html class='no-js' lang='en' > <!--<![endif]-->

    <head>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width' />
    <title>Izmena predmeta -- LEX</title>

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
    <li class='toggle-topbar menu-icon'><a href='#'><span>Menu' /></a></li>
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

    $vrstaOpcije = "<select name='idVrsta'>";

    foreach ($vrstePostupka as $vrsta)
    {
      $vrstaOpcije .= '<option value="'.$vrsta['id'].'">'. $vrsta['id'].' - '.$vrsta['vrsta'].'</option>';
    }
    $vrstaOpcije .= '</select>';

    $tuzeniOpcije = "<select name='tuzeni'>";

    foreach ($stranke as $stranka)
    {
      $tuzeniOpcije .= '<option value="'.$stranka->id.'">'.$stranka->id. ' - '. $stranka->ime.' '.$stranka->prezime.'</option>';
    }
    $tuzeniOpcije .= '</select>';

    $tuzilacOpcije = "<select name='tuzeni'>";

    foreach ($stranke as $stranka)
    {
      $tuzilacOpcije .= '<option value="'.$stranka->id.'">'.$stranka->id. ' - '. $stranka->ime.' '.$stranka->prezime.'</option>';
    }
    $tuzilacOpcije .= '</select>';

    $statusOpcije = "<select name='idStatus'>";

    foreach ($statusi as $status)
    {
      $statusOpcije .= '<option value="'.$status['id'].'">'. $status['id'].' - '.$status['status'].'</option>';
    }
    $statusOpcije .= '</select>';

    $radniciOpcije = "<select name='radnik'>";

    foreach ($radnici as $radnik)
    {
      $radniciOpcije .= '<option value="'.$radnik->id.'">'. $radnik->id.' - ' . $radnik->ime.' '.$radnik->prezime.'</option>';
    }
    $radniciOpcije .='</select>';

    $sudoviOpcije = "<select name='sud'>";

    foreach ($sudovi as $sud)
    {
      $sudoviOpcije .= '<option value="'.$sud->id.'">'. $sud->tipSuda.' '.$sud->grad.'</option>';
    }
    $sudoviOpcije .= '</select>';

    $predmetiSadrzaj = "
    <div class='row'>
    <div class = 'large-6 columns'>
    <form method='post' action='#' id='form'>
    <p><strong>Tužilac:</strong>".$tuzilacOpcije."</p>
    <p><strong>Broj predmeta:</strong><input type='text' name='brojPredmeta' class='required' minlength='3' placeholder='broj predmeta' maxlength='14' size='14' value='".$_SESSION['predmet']->brojPredmeta. "' /></p>
    <p><strong>Promena zaduženja:</strong>".$radniciOpcije."</p>
    <p><strong>Vrsta postupka:</strong>".$vrstaOpcije."</p>
    <p><strong>Vrednost postupka:</strong><input type='text' name='vrednost' class='required' minlength='1' placeholder='broj predmeta' maxlength='14' size='14' value='".$_SESSION['predmet']->vrednost. " dinara' /></p>
    </div>
    <div class = 'large-6 columns'>
    <p><strong>Tuženi:</strong>".$tuzeniOpcije."</p>
    
    <p><strong>Sudski broj:</strong><input type='text' name='sudskiBroj' class='required' minlength='3' placeholder='broj predmeta' maxlength='14' size='14' value='".$_SESSION['predmet']->sudskiBroj. "' /></p>
    <p><strong>Sud:</strong>".$sudoviOpcije."</p> 
    <p><strong>Status predmeta:</strong>".$statusOpcije."</p>
    <p><strong>Fizička lokacija dosijea:</strong><input type='text' name='lokacija' class='required' minlength='1' placeholder='broj predmeta' maxlength='14' size='14' value='".$_SESSION['predmet']->lokacija. "' /></p>
    </div>
    </div>
    <div class='row'>
    <div class='large-4 large-offset-4 centered'>
    <button class='medium success button' name='dugmeIzmeni' id='dugmeIzmeni' type='submit'>Snimi izmene</button>
    <a href='./?id=".$_GET['id']."' class='medium alert button right'>Otkaži</a>
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
}

else 
{ 

  print '<script type="text/javascript">alert("Logovanje je obavezno");
  window.location.href="../../";</script>';
  header("Location: ../../");
}

?>






























