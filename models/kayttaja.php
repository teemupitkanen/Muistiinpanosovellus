<?php

class Kayttaja {

    private $id;
    private $kayttajatunnus;
    private $salasana;

    function __construct() {
    }

    public function tunnista($tunnus, $salasana) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT id FROM kayttaja WHERE username = ? AND password = ?');
        if ($kysely->execute(array($tunnus, $salasana))) {
            return $kysely->fetchColumn();
        } else {
            return null;
        }
    }

    public function kayttajan_id($tunnus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT id FROM kayttaja WHERE username = ?');
        if ($kysely->execute(array($tunnus))) {
            return $kysely->fetchColumn();
        } else {
            return null;
        }
    }

    public function lisaa_kayttaja($tunnus, $salasana) {
        $yhteys = luo_yhteys();
        $lisays = $yhteys->prepare('INSERT INTO kayttaja (username, password) VALUES (?, ?)');
        $lisays->execute(array($tunnus, $salasana));
    }

}

?>
