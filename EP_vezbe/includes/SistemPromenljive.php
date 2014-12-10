<?php
////////////////////////////////////////////////////////////////////////////////////////
// Klasa: SistemPromenljive
// Svrha: Parametri konekcije
///////////////////////////////////////////////////////////////////////////////////////
class SistemPromenljive{
	private static $sistemskep;

    public static function getSistemProm() {
        $sistemskep['dbhost'] = 'localhost';
        $sistemskep['dbkorisnik'] = 'root';
        $sistemskep['dblozinka'] = '';
        $sistemskep['dbime'] = 'km';

        return $sistemskep;
	}
}
?>