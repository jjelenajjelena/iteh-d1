
<?php

require('../../database/db.php');
require('../../models/Prijava.php');

$prijava = new Prijava($conn);

$prijava->id_ustanova = $_GET['id_ustanova'];

echo json_encode($prijava->getPrijave());

$conn->close();
?>