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
        $kysely = $yhteys->prepare('SELECT muistiinpano.otsikko, muistiinpano.prioriteetti, muistiinpano.tunnus FROM muistiinpano, prioriteetti WHERE muistiinpano.kayttaja = ? AND muistiinpano.prioriteetti = prioriteetti.tunnus ORDER BY prioriteetti.arvo DESC');
        if ($kysely->execute(array($kayttajaid))) {
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
        $kysely = $yhteys->prepare('SELECT otsikko, sisalto, prioriteetti FROM muistiinpano WHERE tunnus = ?');
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

}

?>
