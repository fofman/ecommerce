<?php
require_once "Connessione.php";
class Ordine extends Connessione
{
    protected $conn;

    public function __construct()
    {
        $conn = parent::__construct();
    }


    public function getOrdineById($id)
    {

    }

    public function getElementiById($id)
    {
    }

    public function creaOrdine($id_utente, $costo_totale, $items)
    {
        echo $id_utente;
        echo $costo_totale;
        $query = <<<SQL
        INSERT INTO ordini (id_utente, costo_totale)
        VALUES (?, ?);
        SELECT id FROM ordini WHERE id = LAST_INSERT_ID();
        SQL;
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_utente, $costo_totale]);
        $ris = $stmt->fetch(PDO::FETCH_OBJ);
        return $ris;
    }

    public function addToOrdine($id_ordine, $item)
    {
        $query = <<<SQL
        INSERT INTO dettagli_ordini(id_ordine,id_prodotto,prezzo,quantitativo)
        VALUES
        (?,?,?,?)
        SQL;
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_ordine, $item->id_prodotto, $item->prezzo, $item->quantitativo]);
    }
}
