<?php
require_once('../_php/require.php');
session_start();

if(isset($_SESSION['id']))
{
  $stranka = new Stranka;
  $strankaMetode = new StrankaMetode;
  $stranke = $strankaMetode->citaStranke();

  $heder = "
  <!DOCTYPE html>
  <!--[if IE 8]>         <html class='no-js lt-ie9' lang='en' > <![endif]-->
  <!--[if gt IE 8]><!--> <html class='no-js' lang='en' > <!--<![endif]-->

  <head>
  <meta charset='utf-8' />
  <meta name='viewport' content='width=device-width' />
  <title>Sve stranke -- LEX</title>

  <link rel='stylesheet' href='../css/foundation.css' />
  <link rel='stylesheet' href='../css/normalize.css' />

  <script src='../js/vendor/custom.modernizr.js'></script></head>
  <body>
  <nav class='top-bar'>
  <ul class='title-area'>
    <!-- Title Area -->
    <li class='name'>
      <h1><a href='#'>LEX</a></h1>
    </li>
    <!-- Remove the class 'menu-icon' to get rid of menu icon. Take out 'Menu' to just have icon alone -->
    <li class='toggle-topbar menu-icon'><a href='#'><span>Menu</span></a></li>
  </ul>

  <section class='top-bar-section'>
    <!-- Left Nav Section -->
    <ul class='left'>
      <li class='divider'></li>
      <li class='has-dropdown'><a href='#'>Predmeti</a>
        <ul class='dropdown'>
          <li><a href='../predmeti/dodaj/'>Dodaj predmet</a></li>
          <li><a href='../predmeti/'>Svi predmeti</a></li>
          <li><a href='../predmeti/moji/'>Moji predmeti</a></li>
          <li><a href='../predmeti/pretraga/'>Pretraga</a></li>
          <li class='divider'></li>
        </ul>
      </li>
      <li class='divider'></li>
      <li class='has-dropdown active'><a href='#'>Stranke</a>
        <ul class='dropdown'>
         
          <li><a href='../stranke/dodaj/'>Dodaj stranku</a></li>
          <li><a href='../stranke/'>Sve stranke</a></li>
          <li><a href='../stranke/pretraga/'>Pretraga</a></li>
          <li class='divider'></li>
        </ul>
      </li>
      <li class='divider'></li>
      <li class='has-dropdown'><a href='#'>Obaveze</a>
        <ul class='dropdown'>
         
          <li><a href='../'>Dodaj obavezu</a></li>
          <li><a href='../moji/'>Sve obaveze</a></li>
          <li><a href='../predmeti/moji/'>Današnje</a></li>
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
        <a href='../odjava/' name='odjava'>Odjavi se [ " . $_SESSION["ime"] .' '.$_SESSION["prezime"] . " ]</a>
      </li>
    </ul>
  </section>
</nav>";

  $strankeSadrzaj = "<div class='row'>
  
  <div class='large-6 columns large-offset-3'>
  <p><strong>Sve stranke:</strong></p>
  <table>
  <tr><td><strong>Rb.</strong></td><td><strong>Ime</strong></td><td><strong>Prezime</strong></td><td><strong>Adresa</strong></td></tr>";

  $br = 0;
  foreach ($stranke as $stranka)
  {

    $br +=1;
    $strankeSadrzaj .= '<tr><td>'.$br.'.</td><td>'. $stranka->ime .'</td><td>'. $stranka->prezime .'</td><td>'. $stranka->adresa .'</td></tr>';
  }
  

  $strankeSadrzaj.="</table>
  </div>

  </div>";

  $dole = "<script src='../js/foundation.min.js'></script>
  <script src='../js/foundation/foundation.placeholder.js'></script>
  <script src='../js/vendor/jquery.js'></script>
  <script>
  document.write('<script src=' +
    ('__proto__' in {} ? '../js/vendor/zepto' : '../js/vendor/jquery') +
    '.js><\/script>')
</script>
<script src='../js/foundation/foundation.js'></script>

<script src='../js/foundation/foundation.placeholder.js'></script>

<script src='../js/foundation/foundation.topbar.js'></script>

</body>
</html>";
  print $heder.$strankeSadrzaj.$dole;
}

else 
{ 

  print '<script type="text/javascript">alert("Logovanje je obavezno");
  window.location.href="../";</script>';
  header("Location: ../../");
}

?>






























