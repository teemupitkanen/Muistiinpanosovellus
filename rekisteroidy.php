<?php

require_once 'libs/yleiset.php';
include 'models/kayttaja.php';
include 'models/prioriteetti.php';
include 'models/luokka.php';

if ($_POST['salasana'] != $_POST['salasana2']) {
    ohjaa('rekisteroityminen.php?erisala');
}

if (Kayttaja::kayttajan_id($_POST['tunnus']) != null) {
    ohjaa('rekisteroityminen.php?tunnuskaytossa');
} else {
    Kayttaja::lisaa_kayttaja($_POST['tunnus'], $_POST['salasana']);
    Prioriteetti::lisaa_prioriteetti(0,"oletus",Kayttaja::kayttajan_id($_POST['tunnus']));
    Luokka::lisaa_luokka("Oletus",Kayttaja::kayttajan_id($_POST['tunnus']));
    ohjaa('index.php?rek_onnistui');
}
?>