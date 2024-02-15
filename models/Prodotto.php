<?php
require "Connessione.php";
class Prodotto extends Connessione
{
    protected $conn;

    public function __construct()
    {
        $conn = parent::__construct();
    }

    public function newProdotto($id)
    {
    }

    public function removeProdotto($id)
    {
    }

    public function getProdottoByID($id)
    {
        $query = "SELECT * FROM prodotti WHERE id=? AND tipologia='prodotto'";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$id]);

        $ris = $stmt->fetch(PDO::FETCH_OBJ);
        return $ris;
    }

    public function getAccessoriOfID($id)
    {
        $query = "SELECT * FROM prodotti WHERE id_prodotto=? AND tipologia='accessorio'";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$id]);

        $ris = $stmt->fetch(PDO::FETCH_OBJ);
        return $ris;
    }

    public function getProdottoByCreatore($idCreatore)
    {
        $query = "SELECT * FROM prodotti WHERE id_creatore=?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$idCreatore]);

        $ris = $stmt->fetch(PDO::FETCH_OBJ);
        return $ris;
    }

    public function getProdottoByCategoria($categoria)
    {
        $query = "SELECT prodotti.id,prodotti.titolo,prodotti.descrizione,prodotti.prezzo FROM 
        prodotti 
        INNER JOIN
        categorie_prodotti ON prodotti.id = categorie_prodotti.id_prodotto
        INNER JOIN categorie ON categorie_prodotti.id_categoria=categorie.id
        WHERE categorie.titolo = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$categoria]);

        $ris = $stmt->fetch(PDO::FETCH_OBJ);
        return $ris;
    }

    public function getProdottiRecenti($lim)
    {
        $query = "SELECT * FROM prodotti ORDER BY data_aggiunta DESC LIMIT $lim";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $ris = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $ris;
    }
}
