
<?php

require('../../database/db.php');
require('../../models/Prijava.php');

$prijava = new Prijava($conn);

echo json_encode($prijava->getPrijave());

$conn->close();
?>