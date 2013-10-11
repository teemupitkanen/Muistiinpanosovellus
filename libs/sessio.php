<?php
/**
 * Sessio-luokka sisältää metodeja parametrien hallintaan. Tiedoston lopussa luodaan
 * uusi Sessio-olio.
 */

class Sessio {
/**
 * Luo uuden session
 */
  public function __construct() {
    session_start();
  }
/**
 * Asettaa uuden parametrin sessiolle
 * @param type $avain parametrin avain
 * @param type $arvo parametrin arvo
 */
  public function __set($avain, $arvo) {
    $_SESSION[$avain] = $arvo;
  }
/**
 * Palauttaa avainta avstaavan parametrin
 * @param type $avain
 * @return Jos parametri on asetettu, paauttaa sen. Muuten NULL.
 */
  public function __get($avain) {
    if ($this->__isset($avain)) {
      return $_SESSION[$avain];
    }
    return null;
  }
/**
 * Kertoo onko avainta vastaava parametri asetettu.
 * @param type $avain
 * @return boolean true jos on asetettu
 */
  public function __isset($avain) {
    return isset($_SESSION[$avain]);
  }
/**
 * Poistaa avainta vastaavan parametrin
 * @param type $avain
 */
  public function __unset($avain) {
    unset($_SESSION[$avain]);
  }

}

$sessio = new Sessio(); 
?>