<div class="container">

    <h1>Luokat</h1>
    <br>

    <div class="container">
        <table class="table table-striped">
            <tbody>
                <tr>
            <form action="luokat.php?uusi" method="POST">
                <td>
                    <input type="text" name="nimi" id="nimi" placeholder="Luokan nimi">
                </td>
                <td><input type="submit" value="Tallenna uutena"></td>
                <td></td>
            </form>
            </tr>

            <?php
            
            $luokat = $tiedot->luokat;
            
            foreach ($luokat as $luokka) {
                ?>
                <tr>
                <form action="luokat.php?paivita" method="POST">
                    <td>
                        <input type="hidden" name="tunnus" id="tunnus" value="<?php echo $luokka->tunnus; ?>">
                        <input type="hidden" name="vanha_nimi" id="vanha_nimi" value="<?php echo $luokka->nimi; ?>">
                        <input type="text" name="nimi" id="nimi" value="<?php echo $luokka->nimi; ?>">
                    </td>
                    <td><input type="submit" value="Tallenna muutokset"></td>
                </form>
                <form action="luokat.php?poista" method="POST">
                    <input type="hidden" name="tunnus" id="tunnus" value="<?php echo $luokka->tunnus; ?>">
                    <td><input type="submit" value="Poista"></td>
                </form>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>


</div>
