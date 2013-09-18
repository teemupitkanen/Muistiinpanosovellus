<?php

require_once 'yleiset.php';
varmista_kirjautuminen();

function naytaSivu($sivu) {
    include "views/sivupohja.php";
}

naytaSivu("views/listaview.php");
?>
