<?php
/**
 * Tarksitaa rekisteröitymislomakkeen tiedot, ja ohjaa oikealle sivulle tiedoista riippuen.
 */
require_once 'libs/yleiset.php';
include 'models/kayttaja.php';
include 'models/prioriteetti.php';
include 'models/luokka.php';

if(strlen($_POST['salasana'])<4){
    ohjaa('rekisteroityminen.php?lyhytsala');
}
if(strlen($_POST['tunnus'])==""){
    ohjaa('rekisteroityminen.php?tyhjatunnus');
}

if ($_POST['salasana'] != $_POST['salasana2']) {
    ohjaa('rekisteroityminen.php?erisala');
}

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