

<div class="container">
    <h1>Muistilista</h1>
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
                        foreach ($luokat as $luokka) {
                            echo $luokka->nimi;
                            echo ", ";
                        }
//                        $stringit = array("asd", "wasdf");
//                        echo implode(", ", $stringit);
                        ?>
                    </td>
                    <?php include_once 'models/prioriteetti.php'; ?>
                    <td><?php echo Prioriteetti::get_arvo($pano->prioriteetti, $tiedot->kayttaja); ?></td>
                </tr>
            <?php } ?>


        </tbody>
    </table>

    <form class="form-inline">
        Tarkastele muistiinpanoja, joiden prioriteetti on 
        <select>
            <option>mikä tahansa</option>
        </select> 
        ja luokka on
        <select>
            <option>mikä tahansa</option>
        </select>
        .
        <button type="submit" class="btn">Go</button>
    </form>

</div>

