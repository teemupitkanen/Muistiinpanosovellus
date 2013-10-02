<?php

require_once 'libs/yleiset.php';
include 'models/prioriteetti.php';

varmista_kirjautuminen();

$kayttajaid=$sessio->kayttaja_id;

$tiedot->prioriteetit=Prioriteetti::kayttajan_prioriteetit($kayttajaid);

naytaSivu("views/lisaysview.php",$tiedot);
?>
