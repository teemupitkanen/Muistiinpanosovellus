<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
    </head>
    <body><div class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="muistilista.php">Muistilista</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="../uusimuistiinpano.php">Lisää muistiinpano</a></li>
                        <li><a href="../luokat.php">Luokat</a></li>
                        <li><a href="../prioriteetit.php">Prioriteetit</a></li>
                        <li><a href="../kirjaudu.php?ulos" method="POST">Kirjaudu ulos</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            <font color="red">
            <?php
            if (isset($tiedot->errormessage)) {
                echo $tiedot->errormessage;
            }
            ?>
            </font>
            <font color="green">
            <?php
            if (isset($tiedot->positivemessage)) {
                echo $tiedot->positivemessage;
            }
            ?>
            </font>
                
                <?php
            include $sivu;
            ?>
          
            <br><br><br>
            Tietokantasovellus s2013 - Teemu Pitkänen
        </div>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>

