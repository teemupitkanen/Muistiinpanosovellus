<?php
/**
 * Tarkistaa, onko edellinen sivu välittänyt parametrina pyyntöjä suorittaa
 * muutoksia tietokantaan, ja jos on, tekee ne. Lopuksi näyttää prioview-näkymän.
 */
require_once 'libs/yleiset.php';
include 'models/prioriteetti.php';
include 'models/muistiinpano.php';

varmista_kirjautuminen();
$kayttajaid = $sessio->kayttaja_id;

if (isset($_GET['uusi'])) {
    if ($_POST['arvo'] == NULL) {
        $tiedot->errormessage = "Prioriteetin arvona ei voi olla null!";
    }else if ($_POST['arvo'] > 1000 || $_POST['arvo']<-1000) {
        $tiedot->errormessage = "Prioriteetin arvon on oltava väliltä -1000 - 1000!";
    }else if (Prioriteetti::get_tunnus($_POST['arvo'], $kayttajaid) == NULL) {
        Prioriteetti::lisaa_prioriteetti($_POST['arvo'], $_POST['kuvaus'], $kayttajaid);
        $tiedot->positivemessage = "Prioriteetti lisätty!";
    } else {
        $tiedot->errormessage = "Prioriteetin arvon on oltava uniikki ja se on käytössä!";
    }
}


if (isset($_GET['paivita'])) {
    if ($_POST['arvo'] == NULL) {
        $tiedot->errormessage = "Prioriteetin arvona ei voi olla null!";
    } else if ($_POST['arvo'] > 1000 || $_POST['arvo']<-1000) {
        $tiedot->errormessage = "Prioriteetin arvon on oltava väliltä -1000 - 1000!";
    }else if (Prioriteetti::get_tunnus($_POST['arvo'], $kayttajaid) == NULL || $_POST['arvo'] == $_POST['vanha_arvo']) {
        Prioriteetti::paivita_prioriteetti($_POST['arvo'], $_POST['kuvaus'], $_POST['tunnus']);
        $tiedot->positivemessage = "Prioriteetti päivitetty!";
    } else {
        $tiedot->errormessage = "Prioriteetin arvon on oltava uniikki ja se on käytössä!";
    }
}
if (isset($_GET['poista'])) {
    if (Prioriteetti::maara($kayttajaid) == 1) {
        $tiedot->errormessage = "Sinulla on aina oltava ainakin yksi prioriteetti!";
    } else if (Prioriteetti::onko_prioriteetti_kaytossa($_POST['tunnus']) != null) {
        $tiedot->errormessage = "Et voi poistaa prioriteettia, jos se on käytössä!";
    } else {
        Prioriteetti::poista_prioriteetti($_POST['tunnus']);
        $tiedot->positivemessage = "Prioriteetti poistettu!";
    }
}

$tiedot->prioriteetit = Prioriteetti::kayttajan_prioriteetit($kayttajaid);


naytaSivu("views/prioview.php", $tiedot);
?>
