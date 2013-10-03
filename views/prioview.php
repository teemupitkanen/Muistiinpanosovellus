<div class="container">

    <h1>Prioriteetit</h1>
    <br>

    <div class="container">
        <table class="table table-striped">
            <tbody>
                <tr>
            <form action="prioriteetit.php?uusi" method="POST">
                <td>
                    <input type="number" name="arvo" id="arvo" placeholder="Arvo">
                </td>
                <td>
                    <input type="text" name="kuvaus" id="kuvaus" placeholder="Kuvaus">
                </td>
                <td><input type="submit" value="Tallenna uutena"></td>
                <td></td>
            </form>
            </tr>
            <?php
            $prioriteetit = $tiedot->prioriteetit;
            foreach ($prioriteetit as $prio) {
                ?>
                <tr>
                <form action="prioriteetit.php?paivita" method="POST">
                    <td>
                        <input type="hidden" name="tunnus" id="tunnus" value="<?php echo $prio->tunnus; ?>">
                        <input type="hidden" name="vanha_arvo" id="vanha_arvo" value="<?php echo $prio->arvo; ?>">
                        <input type="number" name="arvo" id="arvo" value="<?php echo $prio->arvo; ?>">
                    </td>
                    <td>
                        <input type="text" name="kuvaus" id="kuvaus" value="<?php echo $prio->kuvaus; ?>">
                    </td>
                    <td><input type="submit" value="Tallenna muutokset"></td>
                </form>
                <form action="prioriteetit.php?poista" method="POST">
                    <input type="hidden" name="tunnus" id="tunnus" value="<?php echo $prio->tunnus; ?>">
                    <td><input type="submit" value="Poista"></td>
                </form>
                </tr>
            <?php } ?>




            </tbody>
        </table>
    </div>


</div>
