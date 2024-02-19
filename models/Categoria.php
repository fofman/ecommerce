<?php
require_once "./Connessione.php";
class Categoria extends Connessione
{
    private $conn;

    public function __construct()
    {
        $conn = parent::__construct();
    }

    public function newCategoria($id)
    {
    }

    public function removeCategoria($id)
    {
    }
}
