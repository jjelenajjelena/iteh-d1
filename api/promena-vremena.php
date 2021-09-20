
<?php

require('../database/db.php');
require('../models/Prijava.php');

$prijava = new Prijava($conn);

$prijava->id_korisnik = $_POST['korisnikId'];
$prijava->zakazano_u = $_POST['novoVreme'];

echo $prijava->promenaVremena() ? 'Uspesno promenjena prijava!' : 'Greska prilikom promene prijave';

$conn->close();
?>