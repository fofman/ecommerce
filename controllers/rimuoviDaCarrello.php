<?php
require_once "../models/Carrello.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (!isset($_SESSION["userID"])) {
        header("Location: ../views/login.php", true, 301);
    }
    $c = new Carrello();
    $utente = $_SESSION["userID"];
    if ($utente == $c->getByID($_GET["item"])) {
        $c->removeDaCarrello($_GET["item"]);
    }
}
