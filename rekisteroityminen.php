
<?php
/**
 * Näyttää rekisteröitymisnäkymän.
 */
require_once 'libs/yleiset.php';
if(isset($_GET['lyhytsala'])){
    $tiedot->errormessage = "Salasanan pituus on oltava ainakin 4 merkkiä!";
    naytaSivu("views/rekisteroitymisview.php", $tiedot);
}
else if(isset($_GET['tyhjatunnus'])){
    $tiedot->errormessage = "Käyttäjätunnus ei voi olla tyhjä!";
    naytaSivu("views/rekisteroitymisview.php", $tiedot);
}else if (isset($_GET['erisala'])) {
    $tiedot->errormessage = "Antamasi salasanat eivät täsmää!";
    naytaSivu("views/rekisteroitymisview.php", $tiedot);
} else if (isset($_GET['tunnuskaytossa'])) {
    $tiedot->errormessage = "Valitsemasi tunnus on jo käytössä!";
    naytaSivu("views/rekisteroitymisview.php", $tiedot);
} else {
    naytaSivu("views/rekisteroitymisview.php");
}
?>
