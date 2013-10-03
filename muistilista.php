<?php

require_once 'libs/yleiset.php';
include 'models/muistiinpano.php';
include 'models/prioriteetti.php';
include 'models/luokka.php';

$kayttajaid = $sessio->kayttaja_id;

if (isset($_GET['uusi'])) {
    $prioriteetti = Prioriteetti::get_tunnus($_POST['prio'],$kayttajaid);
    Muistiinpano::lisaa_muistiinpano($kayttajaid, $_POST['nimi'], $_POST['sisalto'], $prioriteetti);
    Luokka::lisaa_yhteys($_POST['luokka'],Muistiinpano::viimeisen_id($kayttajaid));
}

$tiedot->lista = Muistiinpano::kayttajan_muistiinpanot($kayttajaid);
$tiedot->kayttaja = $kayttajaid;

varmista_kirjautuminen();

naytaSivu("views/listaview.php", $tiedot);
?>
