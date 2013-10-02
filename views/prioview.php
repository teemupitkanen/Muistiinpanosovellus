<div class="container">

    <h1>Prioriteetit</h1>
    <br>

    <div class="container">
        <table class="table table-striped">
            <tbody>
                <tr>
            <form action="prioriteetit.php?uusi" method="POST">
                <td>
                    <input type="text" name="arvo" id="arvo" placeholder="Arvo">
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
                    <td>
                        <input type="text" placeholder="<?php echo $prio->arvo; ?>">
                    </td>
                    <td>
                        <input type="text" placeholder="<?php echo $prio->kuvaus; ?>">
                    </td>
                    <td><a href="#">Tallenna muutokset</a></td>
                    <td><a href="#">Poista</a></td>
                </tr>
<?php } ?>




            </tbody>
        </table>
    </div>


</div>
