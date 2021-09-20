<?php

class Ustanova
{
    private $conn;
    private $nazivTabele = "ustanova";

    public $id_prijava;
    public $grad;
    public $adresa;
    public $brojVakcina;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUstanove()
    {
        $sql = "SELECT * FROM " . $this->nazivTabele;


        $rezultat = $this->conn->query($sql);

        $ustanove = [];
        if ($rezultat->num_rows > 0) {
            while ($row = $rezultat->fetch_assoc()) {
                array_push($ustanove, $row);
            }
        }
        return $ustanove;
    }
}
