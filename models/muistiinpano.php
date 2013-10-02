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
        $kysely = $yhteys->prepare('SELECT otsikko, prioriteetti FROM muistiinpano WHERE kayttaja = ? ORDER BY prioriteetti DESC');
        if ($kysely->execute(array($kayttajaid))) {
            $muistiinpanot = array();
            while ($pano = $kysely->fetchObject()) {
                $muistiinpanot[] = $pano;
            }
            return $muistiinpanot;
        }
        return null;
    }

}

?>
