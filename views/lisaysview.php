
<div class="container">
    <h1>Uusi muistiinpano</h1>
    <form action="muistilista.php?uusi" method="POST">
        <fieldset>
            <legend>Täytä muistiinpanon tiedot</legend>
            <label>Muistiinpano:</label>
            <input type="text" name="nimi" id="nimi" placeholder="Otsikko">
            <br><br>
            <label>Tärkeys:</label>
            <select name="prio" id="prio">
                <?php
                $prioriteetit = $tiedot->prioriteetit;
                var_dump($prioriteetit);
                foreach ($prioriteetit as $prio) {
                    ?>

                    <option><?php echo $prio->arvo; ?></option>


<?php } ?>

            </select>
            <br><br>
            <label>Luokka:</label>
            <select>
                <option>-</option>
            </select>
            <br><br>
            <label>Sisältö:</label>
            <textarea rows="3" cols="50" name="sisalto" id="sisalto" placeholder="Tarkempi kuvaus"></textarea>
            <br><br>
            <button type="submit" class="btn">Lisää muistiinpano</button>
        </fieldset>
    </form>
</div>

