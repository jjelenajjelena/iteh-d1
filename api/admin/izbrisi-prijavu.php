
<?php

require('../../database/db.php');
require('../../models/Prijava.php');

$prijava = new Prijava($conn);
$prijava->id_prijava = $_POST['id_prijava'];

if ($prijava->izbrisiPrijavu()) {
    echo "Prijava uspesno obrisana!";
} else echo "Greska prilikom brisanja prijave...";

$conn->close();
?>