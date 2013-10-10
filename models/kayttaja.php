<?php
/** 
 * Käyttäjä-luokka sisältää sovelluksen käyttäjiin liittyviä tietokantakyselyjä 
 * suorittavia funkioita. Käyttäjä-olioilla ei nykyisellään  ole mitään käyttöä
 */
class Kayttaja {

    function __construct() {
    }
/**
 * Palauttaa käyttäjän tunnuksen järjestelmässä
 * 
 * Funkio ottaa parametreina käyttäjän käyttäjätunnuksen ja salasanan, ja
 * palauttaa niiden perusteella järjestelmän sisäisen tunnuksen
 * 
 * @param string $tunnus käyttäjän kirjautuessa syöttämä käyttäjätunnus
 * @param string $salasana käyttäjän kirjautuessa syöttämä salasana
 * @return jos järjestelmässä on käyttäjä, johon tunnukset täsmäisivät, 
 * palauttaa käyttäjän järjestelmän sisäisen tunnuksen (id)
 */
    public function tunnista($tunnus, $salasana) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT id FROM kayttaja WHERE username = ? AND password = ?');
        if ($kysely->execute(array($tunnus, $salasana))) {
            return $kysely->fetchColumn();
        } else {
            return null;
        }
    }
/**
 * Palauttaa käyttäjän tunnuksen käyttäjänimen perusteella
 * 
 * Funkiolle annetaan parametrina käyttäjätunnus, ja se palauttaa ensimmäisen 
 * järjestelmän sisäisen tunnuksen johon salasana täsmää. Ei hyödyllinen, jollei
 * järjestelmässä ole estetty saman käyttäjätunnusken käyttöä
 * 
 * @param string $tunnus käyttäjätunnus
 * @return id järjestelmän sisäinen tunnus
 */
    public function kayttajan_id($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT id FROM kayttaja WHERE username = ?');
        if ($kysely->execute(array($tunnus))) {
            return $kysely->fetchColumn();
        } else {
            return null;
        }
    }
/**
 * Lisää käyttäjän tietokantaan
 * 
 * Funktio ottaa parametrina käyttäjätunnuksen ja salasanan, ja luo käyttäjän 
 * järjestelmään.
 * 
 * @param string $tunnus syötettävän rivin username-kentän arvo
 * @param string $salasana syötettävän rivin password-kentän arvo
 */
    public function lisaa_kayttaja($tunnus, $salasana) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO kayttaja (username, password) VALUES (?, ?)');
        $lisays->execute(array($tunnus, $salasana));
    }

}

?>
