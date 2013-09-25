<?php

require_once 'libs/yleiset.php';
include 'models/kayttaja.php';

if (isset($_GET['sisaan'])) {
    // if ($_POST['tunnus'] == "testitunnus" && $_POST['salasana'] == "testisana") {
    $kayttajanid=Kayttaja::tunnista($_POST['tunnus'], $_POST['salasana']);
    if ($kayttajanid != NULL) {
        $sessio->kayttaja_id = $kayttajanid;
        ohjaa('muistilista.php');
    } else {
        ohjaa('index.php?vaaratunnus');
    }
} elseif (isset($_GET['ulos'])) {
    unset($sessio->kayttaja_id);
    ohjaa('index.php');
} else {
    die('Laiton toiminto!');
}
?>