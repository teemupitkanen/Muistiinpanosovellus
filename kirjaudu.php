<?php
require_once 'yleiset.php';

if (isset($_GET['sisaan'])) {
    if ($_POST['tunnus'] == "testitunnus" && $_POST['salasana'] == "testisana") {
        $sessio->kayttaja_id = 1;
        ohjaa('muistilista.php');
    } else {
        ohjaa('kirjautumissivu.php?vaaratunnus');
    }
} elseif (isset($_GET['ulos'])) {
    unset($sessio->kayttaja_id);
    ohjaa('kirjautumissivu.php');
} else {
    die('Laiton toiminto!');
}
?>