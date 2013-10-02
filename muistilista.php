<?php

require_once 'libs/yleiset.php';
include 'models/muistiinpano.php';

$kayttajaid=$sessio->kayttaja_id;

if (isset($_GET['uusi'])) {
        Muistiinpano::lisaa_muistiinpano($kayttajaid,$_POST['nimi'], $_POST['sisalto'], $_POST['prio']);
}

$tiedot->lista=Muistiinpano::kayttajan_muistiinpanot($kayttajaid);

varmista_kirjautuminen();

naytaSivu("views/listaview.php", $tiedot);
?>
