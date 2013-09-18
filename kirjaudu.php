<?php
require_once 'yleiset.php';

if (isset($_GET['sisaan'])) {
    if ($_POST['tunnus'] == "testitunnus" && $_POST['salasana'] == "testisana") {
        $sessio->kayttaja_id = 1;
        ohjaa('views/muistilista.php');
    } else {
        ohjaa('views/kirjautumissivu.php?');
    }
} elseif (isset($_GET['ulos'])) {
    unset($sessio->kayttaja_id);
    ohjaa('views/kirjautumissivu.php');
} else {
    die('Laiton toiminto!');
}
?>