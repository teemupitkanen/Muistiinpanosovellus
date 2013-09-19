


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
            <tr>
                <td><a href="muistiinpano.php">Käy syömässä</a></td>
                <td>Arkiset</td>
                <td>7 tärkeä</td>
            </tr>
            <tr>
                <td><a href="muistiinpano.php">Matematiikan tentti</a></td>
                <td>Koulu</td>
                <td>10 todella tärkeä</td>
            </tr>
            <tr>
                <td><a href="muistiinpano.php">käy lenkillä</a></td>
                <td>liikunta</td>
                <td>3 ei tärkeä</td>
            </tr>
        </tbody>
    </table>

    <form class="form-inline">
        Tarkastele muistiinpanoja, joiden prioriteetti on 
        <select>
            <option>mikä tahansa</option>
            <option>10</option>
            <option>7</option>
            <option>3</option>
        </select> 
        ja luokka on
        <select>
            <option>mikä tahansa</option>
            <option>Arki</option>
            <option>Koulu</option>
            <option>liikunta</option>
        </select>
        .
        <button type="submit" class="btn">Go</button>
    </form>

</div>
