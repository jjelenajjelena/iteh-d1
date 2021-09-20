
<?php

require('../database/db.php');
require('../models/Ustanova.php');

$ustanova = new Ustanova($conn);

echo json_encode($ustanova->getUstanove());

$conn->close();
?>