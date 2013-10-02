<?php

require_once 'libs/yleiset.php';
include 'models/prioriteetti.php';

$kayttajaid=$sessio->kayttaja_id;

if (isset($_GET['uusi'])) {
        Prioriteetti::lisaa_prioriteetti($_POST['arvo'], $_POST['kuvaus'],$kayttajaid);
}

$tiedot->prioriteetit=Prioriteetti::kayttajan_prioriteetit($kayttajaid);

varmista_kirjautuminen();

naytaSivu("views/prioview.php", $tiedot);
?>
