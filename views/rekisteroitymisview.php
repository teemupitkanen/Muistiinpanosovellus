
<div class="container">

    <h1>Muistilista</h1>
    <p>Syötä haluamasi käyttäjätunnukset:</p>
    <?php
    if (isset($_GET['erisala'])) {
        ?>
        <font color="red">
        <p>Salasanat eivät täsmää!</p>
        </font>
        <?php
    }
    if (isset($_GET['tunnuskaytossa'])) {
        ?>
        <font color="red">
        <p>Käyttäjätunnus on varattu!</p>
        </font>
        <?php
    }
    ?>
    <form action="rekisteroidy.php" method="POST">
        <p><input type="text" name="tunnus" id="tunnus" placeholder="Käyttäjätunnus"/></p>
        <p><input type="password" name="salasana" id="salasana" placeholder="Salasana"/></p>
        <p><input type="password" name="salasana2" id="salasana2" placeholder="Salasana uudelleen"/></p>
        <p><input type="submit" class="btn" value="Rekisteröidy"/></p>
    </form>

</div> 

