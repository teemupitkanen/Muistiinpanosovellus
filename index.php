<?php
/**
 * Sovelluksen kirjautumissivun kontrolleri. Näyttää kirjautumisnäkymän, ja 
 * välittää mahdollisesti tänne ohjatessa saadun viestin näkymään
 */

require_once 'libs/yleiset.php';

if (isset($_GET['vaaratunnus'])) {
    $tiedot->errormessage = "Väärä käyttäjätunnus tai salasana!";
    naytaSivu("views/kirjautumisview.php", $tiedot);
} else if (isset($_GET['rek_onnistui'])) {
    $tiedot->positivemessage = "Rekisteröityminen onnistui. Voit nyt kirjautua sisään!";
    naytaSivu("views/kirjautumisview.php", $tiedot);
} else {
    naytaSivu("views/kirjautumisview.php");
}
?>
