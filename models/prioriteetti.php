<?php

/**
 * Prioriteetti-luokkaan on koottuna prioriteettien hallintaan liittyviä metodeja.
 * Prioriteetti-olioilla ei ole mitään toimintoja.
 */
class Prioriteetti {

    public function __construct() {
        
    }

    /**
     * Lisää uuden prioriteetin tietokantaan
     * 
     * @param int $arvo Prioriteetin arvo
     * @param string $kuvaus Kuvaus prioriteetista esim "tärkeä"
     * @param int $kayttaja Prioriteetin lisänneen käyttäjän tunnus
     */
    public function lisaa_prioriteetti($arvo, $kuvaus, $kayttaja) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO prioriteetti (arvo, kayttaja, kuvaus) VALUES            (?, ?, ?)');
        $lisays->execute(array($arvo, $kayttaja, $kuvaus));
    }

    /**
     * Palauttaa prioriteetin tunnuksen käyttäjn ja arvon perusteella
     * 
     * @param type $arvo Prioriteetin arvo
     * @param type $kayttaja Prioriteetin käyttäjän tunnus
     * @return itn prioriteetin tunnus
     */
    public function get_tunnus($arvo, $kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus FROM prioriteetti WHERE arvo = ? AND kayttaja = ?');
        if ($kysely->execute(array($arvo, $kayttaja))) {
            return $kysely->fetchColumn();
        } else {
            return null;
        }
    }

    /**
     * Palauttaa prioriteetina rvon tunnuksen perusteella
     * @param int $tunnus prioriteetin tunnus
     * @return int prioriteetin arvo
     */
    public function get_arvo($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT arvo FROM prioriteetti WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
        return $kysely->fetchColumn();
    }

    /**
     * Palauttaa prioriteetin täydellisemmät tiedot tunnusken perusteella.
     * @param int $tunnus prioriteetin tunnus
     * @return olio, jolla on seuraavta kentät: arvo, kuvaus, käyttäjä
     */
    public function get_prio($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT arvo, kuvaus, kayttaja FROM prioriteetti WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
        return $kysely->fetchObject();
    }

    /**
     * Palauttaa tietyn käyttäjän kaikki prioriteetit
     * @param type $kayttajaid käyttäjän tunnus
     * @return taulukko, jonka alkiona olevilla olioilla on kentät: arvo, kuvaus, kayttaja ,tunnus
     */
    public function kayttajan_prioriteetit($kayttajaid) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT arvo, kuvaus, kayttaja, tunnus FROM prioriteetti WHERE kayttaja = ? ORDER BY arvo DESC');
        if ($kysely->execute(array($kayttajaid))) {
            $prioriteetit = array();
            while ($prio = $kysely->fetchObject()) {
                $prioriteetit[] = $prio;
            }
            return $prioriteetit;
        }
        return null;
    }

    /**
     * Poistaa prioriteetin tietokannasta
     * @param int $tunnus poistettavan prioriteetin tunnus
     */
    public function poista_prioriteetti($tunnus) {
        $yhteys = luo_yhteys();
        $muutos = $yhteys->prepare('UPDATE muistiinpano SET prioriteetti = null WHERE prioriteetti = ?');
        $muutos->execute(array($tunnus));
        $kysely = $yhteys->prepare('DELETE FROM prioriteetti WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
    }

    /**
     * palauttaa käyttäjän prioriteettien määrän
     * @param int $kayttaja käyttäjän tunnus
     * @return int prioriteettien määrä
     */
    public function maara($kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT count(tunnus) FROM prioriteetti WHERE kayttaja = ?');
        $kysely->execute(array($kayttaja));
        return $kysely->fetchColumn();
    }

    /**
     * Päivittää prioriteetin kentät
     * @param int $arvo uusi arvo
     * @param string $kuvaus uusi kuvaus
     * @param int $tunnus muokattavan tunnus
     */
    public function paivita_prioriteetti($arvo, $kuvaus, $tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('UPDATE prioriteetti SET arvo = ? , kuvaus = ? WHERE tunnus = ?');
        $kysely->execute(array($arvo, $kuvaus, $tunnus));
    }

    /**
     * Auttaa tarkistamaan, liittyykö prioriteettiin muistiinpanoja
     * @param int $prio tarkasteltavan prioriteetin tunnus
     * @return int ensimmäisen prioriteettiin liittyvän muistiinpanon tunnus.
     */
    public function onko_prioriteetti_kaytossa($prio) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus FROM muistiinpano WHERE prioriteetti = ?');
        $kysely->execute(array($prio));
        return $kysely->fetchColumn();
    }

}

?>