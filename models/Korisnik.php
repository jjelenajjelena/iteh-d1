<?php

class Korisnik
{
    private $conn;
    private $nazivTabela = "korisnik";

    public $id_korisnik;
    public $ime;
    public $prezime;
    public $jmbg;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function dodavanjeKorisnika()
    {
        if ($korisnik = $this->getPoJmbg()) {
            return [
                'korisnik' => $korisnik,
                'postoji' => true
            ];
        } else {
            $sql = "INSERT INTO " . $this->nazivTabela . " (ime, prezime, jmbg)
        VALUES ( '" . $this->ime . "' , '" . $this->prezime . "', '" . $this->jmbg . "')";
            $this->conn->query($sql);
            return $this->conn->insert_id;
        }
    }


    private function getPoJmbg()
    {
        $sql = "SELECT * FROM " . $this->nazivTabela . " WHERE jmbg = " . $this->jmbg;
        $result = $this->conn->query($sql);
        $korisnik = null;
        if ($result->num_rows > 0) {
            $korisnik = $result->fetch_assoc();
            return $korisnik;
        }

        return false;
    }
}
