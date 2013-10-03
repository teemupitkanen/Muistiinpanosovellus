
<div class="container">
    <?php
    $mtiedot = $tiedot->muistiinpanon_tiedot;
    $luokat = $tiedot->muistiinpanon_luokat;
    ?>
    <h1>Muistiinpano: <?php echo $mtiedot->otsikko ?></h1>
    
        <p><b>Prioriteetti:</b> <input type="number" value=<?php echo $tiedot->prioriteetti ?>></p>
        <p><b>Luokat:</b> </p> 
        <p>
        <form><?php
            foreach ($luokat as $luokka) {
                echo $luokka->nimi;
                ?>
            <input type="submit" value="Poista">
            </form>
            <?php
        }
        ?>
        <form>
            <select>
                <option>-</option>
            </select>
            <input type="submit" value="Lisää">
        </form>
        </p>
        <p><b>Tiedot:</b> <?php echo $mtiedot->sisalto ?></p>
    
</div>

