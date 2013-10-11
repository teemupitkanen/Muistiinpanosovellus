<?php
/**
 * Funktio luo yhteyden tietokantaan
 * @staticvar PDO $yhteys kahva yhteyteen
 * @return \PDO palauttaa edellä mainitun
 */
function luo_yhteys() {
    static $yhteys;
    if ($yhteys == NULL) {
        $yhteys = new PDO('pgsql:');
        $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $yhteys;
}

?>
