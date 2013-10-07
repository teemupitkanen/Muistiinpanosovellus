<?php

require_once 'libs/yleiset.php';
include 'models/muistiinpano.php';
include 'models/luokka.php';
include 'models/prioriteetti.php';

varmista_kirjautuminen();

if (!isset($_GET['tunnus'])) {
    ohjaa("muistilista.php");
}
if (isset($_GET['vaihdanimi'])) {
    if ($_POST['uusinimi'] != "") {
        Muistiinpano::vaihda_otsikko($_GET['tunnus'], $_POST['uusinimi']);
        $tiedot->positivemessage = "Muistiinpanon otsikko vaihdettu!";
    } else {
        $tiedot->errormessage = "Et voi vaihtaa musitiinpanon nimeksi tyhjää!";
    }
}
if (isset($_GET['uusiluokka'])) {
    Luokka::lisaa_yhteys($_POST['luokka'], $_GET['tunnus']);
    $tiedot->positivemessage = "Luokka lisätty!";
}
if (isset($_GET['luokkapois'])) {
    if (Luokka::yhteyksien_maara($_GET['tunnus']) == 1) {
        $tiedot->errormessage = "Et voi poistaa muistiinpanon viimeistä luokkaa!";
    } else {
        Luokka::poista_yhteys($_POST['luokka'], $_GET['tunnus']);
        $tiedot->positivemessage = "Luokka poistettu!";
    }
}
if (isset($_GET['priovaihdettu'])) {
    Muistiinpano::vaihda_prioriteetti($_GET['tunnus'], $_POST['prior']); // mp tunnus, prio tunnus;
    $tiedot->positivemessage = "Prioriteetti vaihdettu!";
}
if (isset($_GET['uusisisalto'])) {
    Muistiinpano::vaihda_sisalto($_GET['tunnus'], $_POST['sisalto']);
    $tiedot->positivemessage = "Tiedot päivitetty!";
}

$kayttajaid = $sessio->kayttaja_id;

$tiedot->muistiinpanon_tiedot = Muistiinpano::muistiinpanon_tiedot($_GET['tunnus']);
$tiedot->muistiinpanon_luokat = Luokka::muistiinpanon_luokat($_GET['tunnus']);
$tiedot->prioriteetti = Prioriteetti::get_arvo(Muistiinpano::muistiinpanon_tiedot($_GET['tunnus'])->prioriteetti);
$tiedot->kayttajan_prioriteetit = Prioriteetti::kayttajan_prioriteetit($kayttajaid);
$tiedot->kayttajan_luokat = Luokka::kayttajan_luokat($kayttajaid);

naytaSivu("views/muistiinpanoview.php", $tiedot);
?>
