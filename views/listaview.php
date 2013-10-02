

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
// var_dump($muistilista);
            foreach ($muistilista as $pano) {
                ?>
                <tr>
                    <td><?php echo $pano->otsikko; ?></td>
                    <td>Arkiset</td>
                    <td><?php echo $pano->prioriteetti; ?></td>
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

