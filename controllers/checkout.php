<?php
session_start();
require_once "../models/Prodotto.php";
require_once "../models/Carrello.php";
require_once "../models/Ordine.php";
$p = new Prodotto();
$c = new Carrello();
$o = new Ordine();
if (empty($_SESSION["userID"])) {
    header("Location: ./login.php", true, 301);
}
$items_carrello = $c->getOggettiByUtente($_SESSION["userID"]);
$id_ordine=$o->creaOrdine($_SESSION["userID"],$c->getCosto($_SESSION["userID"])->totale);
foreach ($items_carrello as $item) {
    $o->addToOrdine($id_ordine,$item);
}

header("Location: ../views/ordini.php", true, 301);

