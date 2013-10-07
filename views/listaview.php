

<div class="container">
    <h1>Muistilista</h1>
    <br>
    <form class="form-inline" action="muistilista.php?luokka" method="POST">
        Tarkastele muistiinpanoja, joiden luokka on
        <select name="luokka" id="luokka">
            <option value="any">mikä tahansa</option> 
            <?php
            foreach ($tiedot->luokat as $luokka) {
                ?>
                <option value="<?php echo $luokka->tunnus ?>"
                        <?php if ($luokka->tunnus == $tiedot->luokanid) {//$_POST['luokka']){
                            echo "selected";
                        }
                        ?>>
                <?php echo $luokka->nimi ?></option>
    <?php
}
?>
        </select>
        .
        <button type="submit" class="btn">Go</button>
    </form>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Otsikko</th>
                <th>Luokka</th>
                <th>Prioriteetti</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $muistilista = $tiedot->lista;
            foreach ($muistilista as $pano) {
                ?>
                <tr>
                    <td><a href="muistiinpano.php?tunnus=<?php echo $pano->tunnus ?>"><?php echo $pano->otsikko; ?></a></td>
                    <td>
                        <?php
                        include_once 'models/luokka.php';
                        $luokat = Luokka::muistiinpanon_luokat($pano->tunnus);
                        $nimet = array();
                        foreach ($luokat as $luokka) {
                            $nimet[] = $luokka->nimi;
                        }
                        echo implode(", ", $nimet);
                        ?>
                    </td>
                        <?php include_once 'models/prioriteetti.php'; ?>
                    <td>
                        <?php
                        //echo Prioriteetti::get_arvo($pano->prioriteetti, $tiedot->kayttaja); 
                        echo $pano->arvo;
                        echo " - ";
                        echo Prioriteetti::get_prio($pano->prioriteetti)->kuvaus;
                        ?>
                    </td>
                </tr>
<?php } ?>


        </tbody>
    </table>


</div>

