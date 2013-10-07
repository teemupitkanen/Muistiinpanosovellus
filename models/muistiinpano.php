<?php

class Muistiinpano {

    private $tunnus;
    private $muistilista;
    private $otsikko;
    private $sisalto;
    private $prioriteetti;

    public function __construct() {
        
    }

    public function lisaa_muistiinpano($kayttaja, $otsikko, $sisalto, $prioriteetti) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO muistiinpano (kayttaja, otsikko, sisalto, prioriteetti) VALUES          (?, ?, ?, ?)');
        $lisays->execute(array($kayttaja, $otsikko, $sisalto, $prioriteetti));
    }

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

    public function muistiinpanon_tiedot($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT otsikko, sisalto, prioriteetti, tunnus FROM muistiinpano WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
        return $kysely->fetchObject();
    }

    public function viimeisen_id($kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus from muistiinpano where kayttaja = ? order by tunnus ASC');
        $kysely->execute(array($kayttaja));
        while ($tunnus = $kysely->fetchColumn()) {
            $viimeinen = $tunnus;
        }
        return $viimeinen;
    }

    public function vaihda_prioriteetti($tunnus, $prioriteetti) {
        $yhteys = luo_yhteys();
        $muokkaus = $yhteys->prepare('UPDATE muistiinpano set prioriteetti = ? where tunnus = ?');
        $muokkaus->execute(array($prioriteetti, $tunnus));
    }

    public function vaihda_otsikko($tunnus, $otsikko) {
        $yhteys = luo_yhteys();
        $muokkaus = $yhteys->prepare('UPDATE muistiinpano set otsikko = ? where tunnus = ?');
        $muokkaus->execute(array($otsikko, $tunnus));
    }
    public function vaihda_sisalto($tunnus, $sisalto) {
        $yhteys = luo_yhteys();
        $muokkaus = $yhteys->prepare('UPDATE muistiinpano set sisalto = ? where tunnus = ?');
        $muokkaus->execute(array($sisalto, $tunnus));
    }
    public function poista_muistiinpano($tunnus){
        $yhteys = luo_yhteys();
        $luokkapoisto = $yhteys->prepare('DELETE FROM luokan_muistiinpano WHERE muistiinpano = ?');
        $luokkapoisto->execute(array($tunnus));
        $poisto = $yhteys->prepare('DELETE FROM muistiinpano WHERE tunnus = ?');
        $poisto->execute(array($tunnus));
    }

}

?>
