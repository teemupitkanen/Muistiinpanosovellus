
<?php

function naytaSivu($sivu) {
    include "views/sivupohja.php";
}

if (isset($_GET['vaaratunnus'])) {
    echo "vaara";
}
naytaSivu("views/kirjautumisview.php");
?>
