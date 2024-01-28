<?php
class Connessione
{
    private $host = "localhost";
    private $dbname = "ecommerce";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Errore di connessione al database: " . $e->getMessage();
        }
    }

    public function creaAccount($user, $pw)
    {
        $user = trim($user);
        $passwordHash = password_hash($pw, PASSWORD_DEFAULT);
        $query = "INSERT INTO utenti (nome_utente, pw_hash, privilegi, data_creazione) VALUES (?, ?, '0', CURRENT_TIMESTAMP)";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute([$user, $passwordHash]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { //utente esistente
                return 1;
            }
        }
        return 0;
    }

    public function login($user, $pw)
    {
        $user = trim($user);
        $query = "SELECT pw_hash FROM utenti WHERE nome_utente = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$user]);

        $ris = $stmt->fetch(PDO::FETCH_COLUMN, 0);
        if ($ris == false) { //utente non trovato
            return 1;
        }

        if (password_verify($pw, $ris) != true) { //password errata
            return 2;
        } else { //utente esistente e password corretta
            return 0;
        }

        //non vale la pena scrivere 10 righe di codice quindi ecco 2 ternari annidati che fanno la stessa cosa
        //return $stmt->fetch(PDO::FETCH_COLUMN, 0)==false?1:(password_verify($pw, $stmt->fetch(PDO::FETCH_COLUMN, 0))?0 : 2);
    }

    public function getProdottiRecenti($limit)
    {
        $query = "SELECT * FROM prodotti ORDER BY data_aggiunta ASC LIMIT ?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$limit]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
