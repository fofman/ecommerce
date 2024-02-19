<?php
require_once "Connessione.php";
class Carrello extends Connessione
{
    protected $conn;

    public function __construct()
    {
        $conn = parent::__construct();
    }

    public function add($idUtente, $idProdotto, $quantitativo)
    {
        try {
            $query = "INSERT INTO carrelli (quantitativo, id_prodotto, id_utente) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$quantitativo, $idProdotto, $idUtente]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getOggettiByUtente($id)
    {
        $query = <<<SQL
        SELECT carrelli.id,carrelli.quantitativo,carrelli.id_prodotto,carrelli.id_utente,prodotti.id_prodotto AS ref 
        FROM carrelli
        INNER JOIN prodotti
        ON carrelli.id_prodotto=prodotti.id
        WHERE id_utente=?        
        SQL;
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        $ris = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $ris;
    }

    public function getCosto($id){
        $query = <<<SQL
        SELECT SUM(prodotti.prezzo*quantitativo) AS totale
        FROM carrelli 
        INNER JOIN prodotti
            ON carrelli.id_prodotto=prodotti.id
        WHERE id_utente=?
        SQL;
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        $ris = $stmt->fetch(PDO::FETCH_OBJ);
        return $ris;
    }
}