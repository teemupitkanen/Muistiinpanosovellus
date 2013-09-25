<?php

require_once 'libs/yleiset.php';
include 'models/kayttaja.php';

if ($_POST['salasana'] != $_POST['salasana2']) {
    ohjaa('rekisteroityminen.php?erisala');
}

if (Kayttaja::tunnus_kaytossa($_POST['tunnus']) != null) {
    ohjaa('rekisteroityminen.php?tunnuskaytossa');
} else {
    Kayttaja::lisaa_kayttaja($_POST['tunnus'], $_POST['salasana']);
    ohjaa('index.php');
}
?>