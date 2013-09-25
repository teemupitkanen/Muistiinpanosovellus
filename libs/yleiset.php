<?php

require_once 'sessio.php';
require_once 'tietokantayhteys.php';



function naytaSivu($sivu) {
    include "views/sivupohja.php";
}

function ohjaa($osoite) {
    header("Location: $osoite");
    exit;
}

function on_kirjautunut() {
    global $sessio;
    return isset($sessio->kayttaja_id);
}

function varmista_kirjautuminen() {
    if (!on_kirjautunut()) {
        ohjaa('index.php');
    }
}


?>