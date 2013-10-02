<div class="container">

    <h1>Muistilista</h1>
    <p>Kirjaudu sisään:</p>
    <?php
    if (isset($_GET['vaaratunnus'])) {
        ?>
        <font color="red">
        <p>Väärä käyttäjätunnus tai salasana!</p>
        </font>
        <?php
    }
    ?>
    <form action="kirjaudu.php?sisaan" method="POST">
        <p><input type="text" name="tunnus" id="tunnus" placeholder="Käyttäjätunnus"/></p>
        <p><input type="password" name="salasana" id="salasana" placeholder="Salasana"/></p>
        <p><input type="submit" class="btn" value="Kirjaudu"/></p>
    </form>

    <p>Uusi käyttäjä? <a href="rekisteroityminen.php">Rekisteröidy</a> </p>


</div> 
