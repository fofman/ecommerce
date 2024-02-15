<?php
class Connessione
{
    private $host = "localhost";
    private $dbname = "ecommerce";
    private $username = "root";
    private $password = "";
    protected $conn;

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

    public function getConn()
    {
        return $this->conn;
    }
}
