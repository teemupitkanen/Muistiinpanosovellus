<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h3>Rekisteröidy</h3>
        <p>Täytä tietosi palvelun käyttöä varten:</p>
        <form action="omaetusivu.php" method="post">
            <p>Käyttäjätunnus: <input type="text" name="tunnus" /></p>
            <p>Salasana: <input type="password" name="salasana" /></p>
            <p>Kengänkoko: <input type="text" name="kenka" /></p>
            <p>Luottokorttisi numero: <input type="text" name="luotto" /></p>
            <p><input type="submit" value="Kirjaudu"/></p>
        </form>
        
        <p> <a href="index.php">Etusivulle</a> </p>
    </body>
</html>
