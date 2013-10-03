<?php

require_once 'libs/yleiset.php';
include 'models/muistiinpano.php';
include 'models/luokka.php';
include 'models/prioriteetti.php';

varmista_kirjautuminen();

$kayttajaid=$sessio->kayttaja_id;

$tiedot->muistiinpanon_tiedot = Muistiinpano::muistiinpanon_tiedot($_GET['tunnus']);
$tiedot->muistiinpanon_luokat = Luokka::muistiinpanon_luokat($_GET['tunnus']);
$tiedot->prioriteetti = Prioriteetti::get_arvo(Muistiinpano::muistiinpanon_tiedot($_GET['tunnus'])->prioriteetti);
        
naytaSivu("views/muistiinpanoview.php",$tiedot);
?>
