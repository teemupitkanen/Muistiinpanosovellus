<?php
/**
 * Kirjautumistapahtumaa hallinnoiva kontrolleri. Sisäänkirjautuessa tunnistaa 
 * käyttäjän ja ohjaa musitilistaan/ohjaa tunnistamattomat takaisin kirjautumissivulle.
 * Uloskirjautuessa ohjaa kirjautumissivulle.
 */
require_once 'libs/yleiset.php';
include 'models/kayttaja.php';

if (isset($_GET['sisaan'])) {
    $kayttajanid=Kayttaja::tunnista($_POST['tunnus'], $_POST['salasana']);
    if ($kayttajanid != NULL) {
        $sessio->kayttaja_id = $kayttajanid;
        ohjaa('muistilista.php');
    } else {
        ohjaa('index.php?vaaratunnus');
    }
} elseif (isset($_GET['ulos'])) {
    unset($sessio->kayttaja_id);
    ohjaa('index.php');
} else {
    die('Laiton toiminto!');
}
?>