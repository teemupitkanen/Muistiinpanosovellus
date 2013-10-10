<?php

/**
 * Luokka-luokan on kokoelma muistiinpanoluokkien hallinnointiin tietokannassa.
 * Luokka sisältää siis funktioita, jotka suorittavat tietokantakyselyitä.
 * Itse luokka-olioilla ei ole toistaiseksi mitään käytännön arvoa.
 */
class Luokka {

    public function __contruct() {
        
    }

    /**
     * Lisää luokan järjestelmään
     * 
     * Funktio ottaa parametrina tarvittavat arvot, ja suorittaa tarvittavan 
     * tietokantakäskyn luokan lisäämiseksi.
     * 
     * @param string $nimi uuden luokan nimi
     * @param int $kayttaja käyttäjä jolle luokka kuuluu
     */
    public function lisaa_luokka($nimi, $kayttaja) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO luokka (nimi, kayttaja) VALUES (?, ?)');
        $lisays->execute(array($nimi, $kayttaja));
    }

    /**
     * Palauttaa tietokannasta käyttäjän sisäisen tunnuksen perusteella kaikki 
     * käyttäjän luokat
     * 
     * @param int $kayttajaid käyttäjä jonka luokkia haetaan
     * @return palauttaa taulukon olioita, joilla on kaksi kenttää: nimi ja tunnus
     */
    public function kayttajan_luokat($kayttajaid) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT nimi, tunnus FROM luokka WHERE kayttaja = ? ORDER BY nimi');
        if ($kysely->execute(array($kayttajaid))) {
            $luokat = array();
            while ($luokka = $kysely->fetchObject()) {
                $luokat[] = $luokka;
            }
            return $luokat;
        }
        return null;
    }

    /**
     * Palauttaa tietokannasta muistiinpanon tunnuksen perusteella kaikki luokat
     * joihin kyseinen muistiinpano kuuluu
     * 
     * @param int $muistiinpano muistiinpanon tunnus, jonka luokkia haetaan
     * @return palauttaa taulukon olioita, joilla on kaksi kenttää: nimi ja tunnus
     */
    public function muistiinpanon_luokat($muistiinpano) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT luokka.nimi, luokka.tunnus FROM luokka, luokan_muistiinpano WHERE luokan_muistiinpano.muistiinpano = ? AND luokka.tunnus=luokan_muistiinpano.luokka');
        if ($kysely->execute(array($muistiinpano))) {
            $luokat = array();
            while ($luokka = $kysely->fetchObject()) {
                $luokat[] = $luokka;
            }
            return $luokat;
        }
        return null;
    }

    /**
     * Funktio lisää uuden rivin luokan_muistiinpano -tauluun, eli luo tietokantaan 
     * uuden yhteyden luokan ja muistiinpanon välille
     * 
     * @param int $luokka yhteyden luokka
     * @param int $muistiinpano yhteyden muistiinpano
     */
    public function lisaa_yhteys($luokka, $muistiinpano) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO luokan_muistiinpano (luokka, muistiinpano) VALUES (?, ?)');
        $lisays->execute(array($luokka, $muistiinpano));
    }

    /**
     * Funktio palauttaa luokan tunnuksen luokan nimen ja käyttäjän tunnuksen 
     * perusteella. Toimii siis jos muualla on rajoitettu, ettei samalla 
     * käyttäjällä ole kahta samannimistä luokkaa.
     * 
     * @param string $nimi luokan nimi
     * @param int $kayttaja käyttäjän sisäinen tunnus
     * @return palauttaa muistiinpanon tunnuksen
     */
    public function get_tunnus($nimi, $kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus FROM luokka WHERE nimi = ? AND kayttaja = ?');
        if ($kysely->execute(array($nimi, $kayttaja))) {
            return $kysely->fetchColumn();
        } else {
            return null;
        }
    }

    /**
     * Päivittää luokan nimen
     * 
     * @param string $nimi luokan uusi nimi
     * @param int $tunnus luokan tunnus
     */
    public function paivita_luokka($nimi, $tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('UPDATE luokka SET nimi = ? WHERE tunnus = ?');
        $kysely->execute(array($nimi, $tunnus));
    }

    /**
     * Poistaa luokan tietokannasta
     * @param int $tunnus poistettavan luokan tunnus
     */
    public function poista_luokka($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('DELETE FROM luokka WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
    }

    /**
     * Poistaa muistiinpanon yhteyden luokkaan
     * 
     * @param int $luokka luokan tunnus, josta muistiinpano halutaan poistaa
     * @param int $muistiinpano musitiinpanon tunnus, joka poistetaan luokasta
     */
    public function poista_yhteys($luokka, $muistiinpano) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('DELETE FROM luokan_muistiinpano WHERE luokka = ? AND muistiinpano = ?');
        $kysely->execute(array($luokka, $muistiinpano));
    }

    /**
     * Funktio selvittää käyttäjän luokkien määrän
     * 
     * @param int $kayttaja sen käyttäjän tunnus, jonka luokista kyse
     * @return int luokkien määrä
     */
    public function maara($kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT count(tunnus) FROM luokka WHERE kayttaja = ?');
        $kysely->execute(array($kayttaja));
        return $kysely->fetchColumn();
    }

    /**
     * Selvittää, moneenko luokkaan tietty muistiinpano kuuluu
     * @param int $muistiinpano muistiinpanon tunnus
     * @return int luokkien määrä
     */
    public function yhteyksien_maara($muistiinpano) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT count(tunnus) FROM luokan_muistiinpano WHERE muistiinpano= ?');
        $kysely->execute(array($muistiinpano));
        return $kysely->fetchColumn();
    }

    /**
     * Auttaa selvittämään, onko parametrina annettu luokka käytössä. Jos on, 
     * palauttaa ensimmäisen yhteyden tunnuksen.
     * 
     * @param int $tunnus luokan tunnus
     * @return int yhteyden tunnus
     */
    public function onko_luokka_kaytossa($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus FROM luokan_muistiinpano WHERE luokka = ?');
        $kysely->execute(array($tunnus));
        return $kysely->fetchColumn();
    }

}

?>
