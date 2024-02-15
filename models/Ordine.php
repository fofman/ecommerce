<?php
require "./Connessione.php";
class Ordine extends Connessione
{
    private $conn;

    public function __construct()
    {
        $conn = parent::__construct();
    }

    public function getOrdineById($id){

    }

    public function getElementiById($id){

    }


}