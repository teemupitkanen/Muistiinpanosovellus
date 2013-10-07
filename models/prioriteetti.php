<?php

class Prioriteetti {

    private $arvo;
    private $kuvaus;
    private $kayttaja;

    public function __construct() {
        
    }

    public function lisaa_prioriteetti($arvo, $kuvaus, $kayttaja) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO prioriteetti (arvo, kayttaja, kuvaus) VALUES            (?, ?, ?)');
        $lisays->execute(array($arvo, $kayttaja, $kuvaus));
    }

    public function get_tunnus($arvo, $kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus FROM prioriteetti WHERE arvo = ? AND kayttaja = ?');
        if ($kysely->execute(array($arvo, $kayttaja))) {
            return $kysely->fetchColumn();
        } else {
            return null;
        }
    }

    public function get_arvo($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT arvo FROM prioriteetti WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
        return $kysely->fetchColumn();
    }
    public function get_prio($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT arvo, kuvaus, kayttaja FROM prioriteetti WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
        return $kysely->fetchObject();
    }

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

    public function poista_prioriteetti($tunnus) {
        $yhteys = luo_yhteys();
        $muutos = $yhteys->prepare('UPDATE muistiinpano SET prioriteetti = null WHERE prioriteetti = ?');
        $muutos->execute(array($tunnus));
        $kysely = $yhteys->prepare('DELETE FROM prioriteetti WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
    }

    public function maara($kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT count(tunnus) FROM prioriteetti WHERE kayttaja = ?');
        $kysely->execute(array($kayttaja));
        return $kysely->fetchColumn();
    }

    public function paivita_prioriteetti($arvo, $kuvaus, $tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('UPDATE prioriteetti SET arvo = ? , kuvaus = ? WHERE tunnus = ?');
        $kysely->execute(array($arvo, $kuvaus, $tunnus));
    }
    public function onko_prioriteetti_kaytossa($prio) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus FROM muistiinpano WHERE prioriteetti = ?');
        $kysely->execute(array($prio));
        return $kysely->fetchColumn();
    }

}

?>