<?php
/**
 * Tiedosto siältää kokoelman yleiskäyttöisiä funktioita
 */

require_once 'sessio.php';
require_once 'tietokantayhteys.php';


/**
 * Näyttää parametrina saadun sivun. Näyttää sivupohjan includen avulla, ja 
 * sivupohja vastaavasti sisällyttää oikean näkymän oikeaan kohtaan.
 * @param string $sivu näytettävä näkymä
 */
function naytaSivu($sivu,$tiedot=NULL) {
    include "views/sivupohja.php";
}
/**
 * Ohjaa selaimen toiselle sivulle
 * @param string $osoite osoite, johon ohjataan
 */
function ohjaa($osoite) {
    header("Location: $osoite");
    exit;
}
/**
 * Funktio kertoo, onko käyttäjä kirjautunut sisään.
 * @global type $sessio
 * @return boolean true jos käyttäjä on kirjautunut
 */
function on_kirjautunut() {
    global $sessio;
    return isset($sessio->kayttaja_id);
}
/**
 * Funktio, jota käytetään ei-julkisilla sivuilla kirjautumisen varmistamiseen.
 * Jos käyttäjä ei ole kirjautunut, ohjataan etusivulle.
 */
function varmista_kirjautuminen() {
    if (!on_kirjautunut()) {
        ohjaa('index.php');
    }
}


?>