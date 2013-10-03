<?php

require_once 'libs/yleiset.php';
include 'models/luokka.php';

$kayttajaid = $sessio->kayttaja_id;

if (isset($_GET['uusi'])) {
    if ($_POST['nimi'] == "") {
        $tiedot->errormessage = "Luokan nimi ei voi olla tyhjä!";
    } else if (Luokka::get_tunnus($_POST['nimi'], $kayttajaid) != NULL) {
        $tiedot->errormessage = "Kahdella luokalla ei voi olla sama nimi!";
    } else {
        Luokka::lisaa_luokka($_POST['nimi'], $kayttajaid);
        $tiedot->positivemessage = "Luokka lisätty!";
    }
}
if (isset($_GET['paivita'])) {
    if ($_POST['nimi'] == "") {
        $tiedot->errormessage = "Luokan nimi ei voi olla tyhjä!";
    } else if (Luokka::get_tunnus($_POST['nimi'], $kayttajaid) == NULL || $_POST['nimi'] == $_POST['vanha_nimi']) {
        Luokka::paivita_luokka($_POST['nimi'], $_POST['tunnus']);
        $tiedot->positivemessage = "Luokka päivitetty!";
    } else {
        $tiedot->errormessage = "Kahdella luokalla ei voi olla sama nimi!";
    }
}
if (isset($_GET['poista'])) {
    if (Luokka::maara($kayttajaid) == 1) {
        $tiedot->errormessage = "Sinulla on aina oltava ainakin yksi luokka!";
    } 
    else if (Luokka::onko_luokka_kaytossa($_POST['tunnus']) != null) {
        $tiedot->errormessage = "Et voi poistaa luokkaa, jos se on käytössä!";
    } else {
        Luokka::poista_luokka($_POST['tunnus']);
        $tiedot->positivemessage = "Luokka poistettu!";
    }
}

varmista_kirjautuminen();

$tiedot->luokat = Luokka::kayttajan_luokat($kayttajaid);

naytaSivu("views/luokkaview.php", $tiedot);
?>
