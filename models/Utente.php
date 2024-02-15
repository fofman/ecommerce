<?php
require "Connessione.php";
class Utente extends Connessione
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUser($id)
    {
        $query = "SELECT nome_utente FROM utenti WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$id]);

        $ris = $stmt->fetch(PDO::FETCH_COLUMN, 0);
        return $ris;
    }

    public function getPwHash($id)
    {
        $query = "SELECT pw_hash FROM utenti WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$id]);

        $ris = $stmt->fetch(PDO::FETCH_COLUMN, 0);
        return $ris;
    }

    public function getID($user)
    {
        $query = "SELECT id FROM utenti WHERE nome_utente=?";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$user]);

        $ris = $stmt->fetch(PDO::FETCH_COLUMN, 0);
        return $ris;
    }

    public function creaUtente($user, $pw)
    {
        $user = trim($user);
        if ($this->getID($user) != false) {
            return 1; //utente esistente
        }

        $passwordHash = password_hash($pw, PASSWORD_DEFAULT);
        $query = "INSERT INTO utenti (nome_utente, pw_hash, privilegi, data_creazione) VALUES (?, ?, 'visualizzatore', CURRENT_TIMESTAMP)";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$user, $passwordHash]);
        return 0;
    }

    public function login($user, $pw)
    {
        $user = trim($user);

        $pwHash = $this->getPwHash($this->getID($user));

        if ($pwHash == false) { //utente non trovato
            return 1;
        }

        if (password_verify($pw, $pwHash) != true) { //password errata
            return 2;
        } else { //utente esistente e password corretta
            return 0;
        }
        //non vale la pena scrivere 10 righe di codice quindi ecco 2 ternari annidati che fanno la stessa cosa
        //return $stmt->fetch(PDO::FETCH_COLUMN, 0)==false?1:(password_verify($pw, $stmt->fetch(PDO::FETCH_COLUMN, 0))?0 : 2);
    }

    public function cancellaUtente($user, $pw)
    {
        $user = trim($user);

        $pwHash = $this->getPwHash($this->getID($user));
        if ($pwHash == false) { //utente non trovato
            return 1;
        }

        if (password_verify($pw, $pwHash) != true) { //password errata
            return 2;
        } else { //utente esistente e password corretta

            $query = "DELETE FROM utenti WHERE nome_utente=?";
            $stmt = $this->conn->prepare($query);

            $stmt->execute([$user]);

            return 0;
        }
    }
}
