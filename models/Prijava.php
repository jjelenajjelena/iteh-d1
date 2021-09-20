<?php

class Prijava
{
    private $conn;
    private $nazivTabela = "prijava_vakcinacija";

    public $id_prijava;
    public $id_ustanova;
    public $broj_prijava;
    public $zakazano_u;
    public $id_korisnik;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getPrijave()
    {
        if (!$this->id_ustanova) {
            $sql = "SELECT * FROM " . $this->nazivTabela . " pk 
                JOIN korisnik k ON k.id_korisnik = pk.id_korisnik 
                JOIN ustanova u on u.id_ustanova = pk.id_ustanova 
                ORDER BY zakazano_u ASC";
        } else $sql = "SELECT * FROM " . $this->nazivTabela . " pk 
        JOIN korisnik k ON k.id_korisnik = pk.id_korisnik 
        JOIN ustanova u on u.id_ustanova = pk.id_ustanova 
        WHERE pk.id_ustanova = " . $this->id_ustanova . "
        ORDER BY zakazano_u ASC";

        $result = $this->conn->query($sql);

        $svePrijave = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['zakazano_u'] = date('d.m h:i:s', $row['zakazano_u']);
                array_push($svePrijave, $row);
            }
        }
        return $svePrijave;
    }


    public function dodavanjePrijave()
    {
        $ustanovaSQL = "SELECT * FROM ustanova WHERE id_ustanova = " . $this->id_ustanova;
        $ustanova = ($this->conn->query($ustanovaSQL)->fetch_assoc());

        if ($ustanova['broj_vakcina'] <= 0) {
            echo "Na stanju nema vakcina.";
            return false;
        }


        if ($poslednjaPrijava = $this->vratiPoslednjuPrijavu()) {
            $zakazano_u = intval($poslednjaPrijava['zakazano_u']) + 900;
        } else {
            $zakazano_u = 1626328800; // Thu Jul 15 2021 06:00:00 GMT+0000 (https://www.unixtimestamp.com/index.php)

        }

        $sql = "INSERT INTO " . $this->nazivTabela . " (id_korisnik, id_ustanova, zakazano_u)
        VALUES ( $this->id_korisnik  , $this->id_ustanova, $zakazano_u)";
        
        $this->smanjiBrojVakcina();
        if ($this->conn->query($sql) === TRUE) {
            echo json_encode([
                'poruka' => "Zakazali ste vakcinaciju, dodjite u: " . date("d.m h:i:s", $zakazano_u),
                'postoji' => false
            ]);
            return true;
        }
        echo "Doslo je do greske";
        return false;
    }


    public function izbrisiPrijavu()
    {
        $sql = "DELETE FROM " . $this->nazivTabela . " WHERE id_prijava = " . $this->id_prijava;
        if ($this->conn->query($sql) === TRUE) return true;
        return false;
    }

    private function smanjiBrojVakcina()
    {
        $sql = "UPDATE ustanova SET broj_vakcina = broj_vakcina-1 WHERE id_ustanova = " . $this->id_ustanova;
        $this->conn->query($sql);
    }

    public function vratiPoslednjuPrijavu()
    {
        $sql = "SELECT * FROM " . $this->nazivTabela . " WHERE id_ustanova = " . $this->id_ustanova . " ORDER BY zakazano_u DESC LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result) {
            $poslednjaPrijava =  $result->fetch_assoc();

            return $poslednjaPrijava;
        } else {
            return false;
        }
    }

    public function promenaVremena()
    {
        $sql = "UPDATE " . $this->nazivTabela . " SET zakazano_u = " . $this->zakazano_u . " WHERE id_korisnik = " . $this->id_korisnik;
        if ($this->conn->query($sql) === TRUE) return true;
        return false;
    }

    // private function postojiPrijavaZaKorisnika()
    // {
    //     $sql = "SELECT * FROM " . $this->nazivTabela . " WHERE id_korisnik = " . $this->id_korisnik;
    //     $result = $this->conn->query($sql);
    //     if ($result) {
    //         $prijava =  $result->fetch_assoc();

    //         return $prijava;
    //     } else {
    //         return false;
    //     }
    // }
}
