<?php

class Luokka {

    public function __contruct() {
        
    }

    public function lisaa_luokka($nimi, $kayttaja) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO luokka (nimi, kayttaja) VALUES (?, ?)');
        $lisays->execute(array($nimi, $kayttaja));
    }

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

    public function lisaa_yhteys($luokka, $muistiinpano) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO luokan_muistiinpano (luokka, muistiinpano) VALUES (?, ?)');
        $lisays->execute(array($luokka, $muistiinpano));
    }

    public function get_tunnus($nimi, $kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus FROM luokka WHERE nimi = ? AND kayttaja = ?');
        if ($kysely->execute(array($nimi, $kayttaja))) {
            return $kysely->fetchColumn();
        } else {
            return null;
        }
    }

    public function paivita_luokka($nimi, $tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('UPDATE luokka SET nimi = ? WHERE tunnus = ?');
        $kysely->execute(array($nimi, $tunnus));
    }

    public function poista_luokka($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('DELETE FROM luokka WHERE tunnus = ?');
        $kysely->execute(array($tunnus));
    }
    
    public function poista_yhteys($luokka, $muistiinpano){
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('DELETE FROM luokan_muistiinpano WHERE luokka = ? AND muistiinpano = ?');
        $kysely->execute(array($luokka, $muistiinpano));
    }

    public function maara($kayttaja) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT count(tunnus) FROM luokka WHERE kayttaja = ?');
        $kysely->execute(array($kayttaja));
        return $kysely->fetchColumn();
    }   
    public function yhteyksien_maara($muistiinpano){
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT count(tunnus) FROM luokan_muistiinpano WHERE muistiinpano= ?');
        $kysely->execute(array($muistiinpano));
        return $kysely->fetchColumn();
    }
    
    public function onko_luokka_kaytossa($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT tunnus FROM luokan_muistiinpano WHERE luokka = ?');
        $kysely->execute(array($tunnus));
        return $kysely->fetchColumn();
    }

}

?>
