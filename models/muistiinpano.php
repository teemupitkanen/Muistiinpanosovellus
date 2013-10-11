<?php

/**
 * Muistiinpano-luokkaan on säilöttynä muistiinpanojen hallintaan liittyviä 
 * funktioita. Muistiinpano-olioilla ei ole virkaa.
 */
class Muistiinpano {

    public function __construct() {
        
    }

    /**
     * Funktio lisää uuden muistiinpanon tietokantaan
     * 
     * @param int $kayttaja muistiinpanon lisännyt käyttäjä (tunnus)
     * @param string $otsikko muistiinpanon otsikko
     * @param string $sisalto muistiinpanon sisältö
     * @param int $prioriteetti muistiinpanon prioriteetin tunnus
     */
    public function lisaa_muistiinpano($kayttaja, $otsikko, $sisalto, $prioriteetti) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO muistiinpano (kayttaja, otsikko, sisalto, prioriteetti) VALUES          (?, ?, ?, ?)');
        $lisays->execute(array($kayttaja, $otsikko, $sisalto, $prioriteetti));
    }

    /**
     * Palauttaa tietyn käyttäjän muistiinpanot
     * @param int $kayttajaid käyttäjän tunnus
     * @return palauttaa taulukon olioita, joilla on kentät otsikko, prioriteetti, tunnus, arvo
     */
    public function kayttajan_muistiinpanot($kayttajaid) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT muistiinpano.otsikko, muistiinpano.prioriteetti, muistiinpano.tunnus, prioriteetti.arvo FROM muistiinpano, prioriteetti WHERE muistiinpano.kayttaja = ? AND muistiinpano.prioriteetti = prioriteetti.tunnus ORDER BY prioriteetti.arvo DESC');
        if ($kysely->execute(array($kayttajaid))) {
            $muistiinpanot = array();
            while ($pano = $kysely->fetchObject()) {
                $muistiinpanot[] = $pano;
            }
            return $muistiinpanot;
        }
        return null;
    }

    /**
     * Funktio palauttaa kaikkien tiettyyn luokkaan kuuluvien muistiinpanojen tiedot
     * 
     * @param int $luokkaid luokka, johon kuuluvi muistiinpanoja halutaan tarkastella.
     * @return Palauttaa taulukon olioita, joilla on kentät otsikko, prioriteetti, tunnus, arvo
     */
    public function luokan_muistiinpanot($luokkaid) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT muistiinpano.otsikko, muistiinpano.prioriteetti, muistiinpano.tunnus, prioriteetti.arvo FROM muistiinpano, prioriteetti, luokan_muistiinpano WHERE muistiinpano.prioriteetti = prioriteetti.tunnus AND muistiinpano.tunnus=luokan_muistiinpano.muistiinpano AND luokan_muistiinpano.luokka = ? ORDER BY prioriteetti.arvo DESC');
        if ($kysely->execute(array($luokkaid))) {
            $muistiinpanot = array();
            while ($pano = $kysely->fetchObject()) {
                $muistiinpanot[] = $pano;
            }
            return $muistiinpanot;
        }
        return null;
    }

    /**
     * Funktio palauttaa yksittäisen muistiinpanon tarkemmat tiedot tunnuksen perusteella
     * 
     * @param int $tunnus muistiinpanon tunnus
     * @return palauttaa olion, jolla kentät otsikko, sisalto, prioriteetti, tunnus
     */
    public function muistiinpanon_tiedot($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT otsikko, sisalto, prioriteetti, tunnus FROM muistiinpano WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
        return $kysely->fetchObject();
    }

    /**
     * Palauttaa suurimmalla tunnuksella olevan musitiinpanon tunnuksen.
     * 
     * @param int $kayttaja sen käyttäjän tunnus, jonka muistiinpanoa haetaan
     * @return int muistiinpanon tunnus
     */
    public function viimeisen_id($kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus from muistiinpano where kayttaja = ? order by tunnus ASC');
        $kysely->execute(array($kayttaja));
        while ($tunnus = $kysely->fetchColumn()) {
            $viimeinen = $tunnus;
        }
        return $viimeinen;
    }

    /**
     * Vaihtaa muistiinpanon prioriteettia
     * 
     * @param int $tunnus muistiinpanon tunnus
     * @param int $prioriteetti uuden prioriteetin tunnus
     */
    public function vaihda_prioriteetti($tunnus, $prioriteetti) {
        $yhteys = luo_yhteys();
        $muokkaus = $yhteys->prepare('UPDATE muistiinpano set prioriteetti = ? where tunnus = ?');
        $muokkaus->execute(array($prioriteetti, $tunnus));
    }

    /**
     * Vaihtaa musitiinpanon otsikkoa
     * 
     * @param int $tunnus muistiinpanon tunnus
     * @param string $otsikko uusi otsikko
     */
    public function vaihda_otsikko($tunnus, $otsikko) {
        $yhteys = luo_yhteys();
        $muokkaus = $yhteys->prepare('UPDATE muistiinpano set otsikko = ? where tunnus = ?');
        $muokkaus->execute(array($otsikko, $tunnus));
    }

    /**
     * Vaihtaa muistiipanon sisältötekstiä
     * 
     * @param type $tunnus muistiinpanon tunnus
     * @param type $sisalto uusi sisältö
     */
    public function vaihda_sisalto($tunnus, $sisalto) {
        $yhteys = luo_yhteys();
        $muokkaus = $yhteys->prepare('UPDATE muistiinpano set sisalto = ? where tunnus = ?');
        $muokkaus->execute(array($sisalto, $tunnus));
    }

    /**
     * Poistaa muistiinpanon tietokannasta tunnuksen perusteella
     * 
     * @param int $tunnus poistettavan musitiinpanon tunnus
     */
    public function poista_muistiinpano($tunnus) {
        $yhteys = luo_yhteys();
        $luokkapoisto = $yhteys->prepare('DELETE FROM luokan_muistiinpano WHERE muistiinpano = ?');
        $luokkapoisto->execute(array($tunnus));
        $poisto = $yhteys->prepare('DELETE FROM muistiinpano WHERE tunnus = ?');
        $poisto->execute(array($tunnus));
    }

}

?>
