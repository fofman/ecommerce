<?php
require_once "../models/Prodotto.php";
require_once "../models/Carrello.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!isset($_SESSION["userID"])){
        header("Location: ../views/login.php",true,301);
    }
    $p = new Prodotto();
    $c = new Carrello();
    echo var_dump($_POST);
    if (isset($_POST["accessori"])) {
        $prodotti = array_merge([$_POST["prodotto"]], $_POST["accessori"]);
    } else {
        $prodotti = [$_POST["prodotto"]];
    }

    foreach ($prodotti as $prodotto) {
        echo $c->add($_SESSION["userID"], $prodotto, $_POST["quantitativo"]);
    }
}
