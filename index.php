<?php
require "./models/Prodotto.php";
session_start();
$p = new Prodotto();
$prodotti = $p->getProdottiRecenti(0);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <?php include_once "./views/components/dipendenze.php"; ?>
    <link rel="stylesheet" href="./public/static/index/style.css">
</head>

<body>
    <header class="d-flex justify-content-center py-2 sticky-top bg-light">
        <ul class="nav nav-pills lead">
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="nav-item"><a href="./views/carrello.php" class="nav-link"><i class="bi bi-cart-fill"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-person-circle"></i></a></li>
        </ul>
    </header>
    <main>
        <div class="container mt-5 row mx-auto">
            <?php foreach ($prodotti as $prodotto) {
                echo <<<HTML
            <div class="col-lg-3 col-md-5 mb-4 d-flex align-items-stretch flex-md-fill flex-lg-grow-0">
                <div class="card overflow-hidden flex-fill">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Furniture 1">
                    <div class="card-body">
                        <h5 class="card-title">$prodotto->titolo</h5>
                        <p class="card-text">$prodotto->descrizione</p>
                        <p class="card-text">A partire da $prodotto->prezzo €</p>
                        <a href="./views/prodotto.php?prodotto=$prodotto->id" class="btn btn-primary">Vedi di più</a>
                    </div>
                </div>
            </div>
        HTML;
            } ?>
        </div>
    </main>
    <?php include_once "./views/components/footer.php"; ?>
</body>

</html>