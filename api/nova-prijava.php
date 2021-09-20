<?php
require('../database/db.php');
require('../models/Prijava.php');
require('../models/Korisnik.php');

// korisnik
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$jmbg = $_POST['jmbg'];

// ustanova
$ustanovaId = $_POST['ustanovaId'];

$korisnik = new Korisnik($conn);

$korisnik->ime = $ime;
$korisnik->prezime = $prezime;
$korisnik->jmbg = $jmbg;

$prijava = new Prijava($conn);
$prijava->id_ustanova = $ustanovaId;

$korisnikObjekat = $korisnik->dodavanjeKorisnika();
if (is_numeric($korisnikObjekat)) {
    $prijava->id_korisnik = $korisnikObjekat;
    $prijava->dodavanjePrijave();
} else {
    $poslednjaPrijava = $prijava->vratiPoslednjuPrijavu();
    // https://linuxhint.com/merge-objects-php/
    echo json_encode(
        (object) array_merge(
            (array)['novoVreme' => date("d.m h:i:s", intval($poslednjaPrijava['zakazano_u']) + 900)],
            (array)['novoVremeTimestamp' => intval($poslednjaPrijava['zakazano_u']) + 900],
            (array) $korisnikObjekat
        )
    );
}
$conn->close();
