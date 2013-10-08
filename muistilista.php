<?php

require_once 'libs/yleiset.php';
include 'models/muistiinpano.php';
include 'models/prioriteetti.php';
include 'models/luokka.php';

varmista_kirjautuminen();
$kayttajaid = $sessio->kayttaja_id;

if (isset($_GET['uusi'])) {
    if (isset($_POST['luokka']) && $_POST['nimi']!="") {
        $prioriteetti = Prioriteetti::get_tunnus($_POST['prio'], $kayttajaid);
        Muistiinpano::lisaa_muistiinpano($kayttajaid, $_POST['nimi'], $_POST['sisalto'], $prioriteetti);
        foreach ($_POST['luokka'] as $luokka) {
            Luokka::lisaa_yhteys($luokka, Muistiinpano::viimeisen_id($kayttajaid));
        }
    }else if(!isset($_POST['nimi']) || $_POST['nimi']==""){
        $tiedot->errormessage = "Muistiinpanon lisäys epäonnistui. Muistiinpanon nimi ei voi olla tyhjä!";
    }
    else{
        $tiedot->errormessage = "Muistiinpanon lisäys epäonnistui. Sinun tulee asettaa muistiinpanoillesi vähintään yksi luokka!";
    }
}

if (isset($_GET['poistamp'])) {
    Muistiinpano::poista_muistiinpano($_POST['tunnus']);
    $tiedot->positivemessage = "Muistiinpano poistettu!";
}

if (isset($_GET['luokka'])) {
    $tiedot->luokanid = $_POST['luokka'];
    if ($_POST['luokka'] != "any") {
        $tiedot->lista = Muistiinpano::luokan_muistiinpanot($_POST['luokka']);
    } else {
        $tiedot->lista = Muistiinpano::kayttajan_muistiinpanot($kayttajaid);
    }
} else {
    $tiedot->luokanid = NULL;
    $tiedot->lista = Muistiinpano::kayttajan_muistiinpanot($kayttajaid);
}
$tiedot->kayttaja = $kayttajaid;
$tiedot->luokat = Luokka::kayttajan_luokat($kayttajaid);


naytaSivu("views/listaview.php", $tiedot);
?>
