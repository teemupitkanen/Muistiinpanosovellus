
<div class="container">
    <?php
    $mtiedot = $tiedot->muistiinpanon_tiedot;
    $luokat = $tiedot->muistiinpanon_luokat;
    $prioriteetit = $tiedot->kayttajan_prioriteetit;
    $kayttajan_luokat = $tiedot->kayttajan_luokat;
    $luokkien_nimet = array();
    foreach ($luokat as $luokka) {
        $luokkien_nimet[] = $luokka->nimi;
    }
    ?>
    <h1>Muistiinpano: <?php echo $mtiedot->otsikko ?></h1>
    <p>
    <form action="muistiinpano.php?tunnus=<?php echo $mtiedot->tunnus; ?>&vaihdanimi" method="POST">
        <input type="text" name="uusinimi" id="uusinimi" placeholder="Uusi otsikko">
        <input type="submit" value="Tallenna muutos">
    </form>
</p>
<p><b>Prioriteetti:</b> </p> 
<table class="table table-striped">
    <tbody>
        <tr>
    <form action="muistiinpano.php?tunnus=<?php echo $mtiedot->tunnus; ?>&priovaihdettu" method="POST">
        <td>
            <select name="prior" id="prior">
                <?php
                foreach ($prioriteetit as $prio) {
                    ?>
                    <option <?php
                    if ($prio->arvo == $tiedot->prioriteetti) {
                        echo "selected";
                    }
                    ?> value="<?php echo $prio->tunnus ?>">
                            <?php echo $prio->arvo; 
                            echo " - ";
                            echo $prio->kuvaus;
                            
                            ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </td>
        <td>
            <input type="submit" value="Tallenna muutos">
        </td>
    </form>
    </tr>
    </tbody>
</table>
<p><b>Luokat:</b> </p> 

<table class="table table-striped">
    <tbody>

        <?php
        foreach ($luokat as $luokka) {
            ?>
            <tr><form action="muistiinpano.php?tunnus=<?php echo $mtiedot->tunnus; ?>&luokkapois" method="POST">
            <td>
                <input type="hidden" name="luokka" id="luokka" value="<?php echo $luokka->tunnus ?>">
                <?php
                echo $luokka->nimi;
                ?>
            </td>
            <td>
                <input type="submit" value="Poista">
            </td>
        </form>
        </tr>

        <?php
    }
    if(sizeof($luokat) != sizeof($kayttajan_luokat)){
    ?>
    <tr><form action="muistiinpano.php?tunnus=<?php echo $mtiedot->tunnus; ?>&uusiluokka" method="POST">
        <td>
            <select name="luokka" id="luokka">
                <?php
                foreach ($kayttajan_luokat as $luokka) {
                    if (!(in_array($luokka->nimi, $luokkien_nimet))) {
                        ?>
                        <option value="<?php echo $luokka->tunnus ?>">
                            <?php echo $luokka->nimi; ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
        </td>
        <td>
            <input type="submit" value="Lisää">
        </td>
    </form>
    </tr>
    <?php } ?>
    </tbody>
</table>
<p><b>Tiedot:</b></p>
<form action="muistiinpano.php?tunnus=<?php echo $mtiedot->tunnus; ?>&uusisisalto" method="POST"> 
    <p><textarea rows="5" cols="100" name="sisalto" id="sisalto"><?php echo $mtiedot->sisalto ?></textarea></p>
    <p><input type="submit" value="Tallenna muutos"></p>
</form>
<br>
<form action="muistilista.php?poistamp" method="POST">
    <p>
        <input type="hidden" name="tunnus" id="tunnus" value="<?php echo $mtiedot->tunnus; ?>">
        <input type="submit" value="Poista muistiinpano"
    </p>
</form>

</div>

