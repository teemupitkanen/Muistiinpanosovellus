<?php
include "yleisnakyma.php";
?>

<div class="container">

    <h1>Muistilista</h1>
    <p>Kirjaudu sisään</p>

    <form action="../kirjaudu.php?sisaan" method="POST">
        <p><input type="text" name="tunnus" id="tunnus" placeholder="Käyttäjätunnus"/></p>
        <p><input type="password" name="salasana" id="salasana" placeholder="Salasana"/></p>
        <p><input type="submit" value="Kirjaudu"/></p>
    </form>

    <p>Uusi ? <a href="rekisteroitymissivu.php">Rekisteröidy</a> </p>


</div> 

