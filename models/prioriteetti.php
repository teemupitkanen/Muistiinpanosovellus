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

    public function kayttajan_prioriteetit($kayttajaid) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('SELECT arvo, kuvaus, kayttaja FROM prioriteetti WHERE kayttaja = ? ORDER BY arvo DESC');
        if ($kysely->execute(array($kayttajaid))) {
            $prioriteetit = array();
            while ($prio = $kysely->fetchObject()) {
                $prioriteetit[] = $prio;
            }
            return $prioriteetit;
        }
        return null;
    }

    public function poista_prioriteetti($kayttajaid, $arvo) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('DELETE FROM prioriteetti WHERE kayttaja = ? AND arvo = ?');
        $kysely->execute(array($kayttajaid, $arvo));
    }

    public function paivita_prioriteetti($kayttajaid, $arvo, $kuvaus) {
        $yhteys = luo_yhteys();
        $kysely = $yhteys->prepare('UPDATE prioriteetti SET kuvaus = ? WHERE kayttaja = ? AND arvo = ?');
        $kysely->execute(array($kuvaus, $kayttajaid, $arvo));
    }

}

?>