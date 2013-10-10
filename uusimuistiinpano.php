<?php
/**
 * Kontrolleri näyttää uuden muistiinpanon lisäämisnäkymän.
 */
require_once 'libs/yleiset.php';
include 'models/prioriteetti.php';
include 'models/luokka.php';

varmista_kirjautuminen();

$kayttajaid=$sessio->kayttaja_id;

$tiedot->prioriteetit=Prioriteetti::kayttajan_prioriteetit($kayttajaid);
$tiedot->luokat=Luokka::kayttajan_luokat($kayttajaid);

naytaSivu("views/lisaysview.php",$tiedot);
?>
