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
        Hei <?php echo htmlspecialchars($_POST['tunnus']); ?>.<BR>
        Salasanasi on <?php echo htmlspecialchars($_POST['salasana']); ?>.
        <p> <a href="index.php">Kirjaudu ulos</a> </p>
    </body>
</html>
