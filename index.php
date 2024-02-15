<?php
require "./models/Prodotto.php";
session_start();
$p = new Prodotto();
$prodotti = $p->getProdottiRecenti(5);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include_once "./views/components/header.php"; ?>
    <?php foreach($prodotti as $prodotto){
        echo $prodotto->titolo."<br>";
    } ?>
</body>

</html>