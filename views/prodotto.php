<?php

if (empty($_GET["prodotto"])) {
    header("HTTP/1.1 404");
    die();
}

require "../models/Prodotto.php";
session_start();
$p = new Prodotto();
$prodotto = $p->getProdottoByID($_GET["prodotto"]);
$accessori = $p->getAccessoriOfID($_GET["prodotto"]);

$formAccessori = [];

foreach ($accessori as $accessorio) {
    $formAccessori[] = <<<HTML
            <li class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <input class="form-check-input me-1" type="checkbox" id="{$accessorio->id}" name="accessori[]" value="{$accessorio->id}">                        
                    </div>
                    <div class="col">

                        <label class="form-check-label stretched-link" for="{$accessorio->id}">
                            <div class="fw-bold">$accessorio->titolo</div>
                            <div class="fst-italic">$accessorio->descrizione</div>
                        </label>
                    </div>
                    <div class="col-auto text-end">
                        {$accessorio->prezzo} €
                    </div>
                </div>
            </li>
        HTML;
}
$formAccessori = join("\n", $formAccessori);

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php include_once "./components/dipendenze.php"; ?>
    <link rel="stylesheet" href="../public/static/prodotto/style.css">
</head>

<body>
    <header class="d-flex justify-content-center py-2 sticky-top bg-light">
        <ul class="nav nav-pills lead">
            <li class="nav-item"><a href="../index.php" class="nav-link" aria-current="page"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="nav-item"><a href="./carrello.php" class="nav-link"><i class="bi bi-cart-fill"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-person-circle"></i></a></li>
        </ul>
    </header>
    <br>
    <main class="container">
        <?php
        echo <<<HTML
        <form class="row" method="post" action="../controllers/carrello.php">
            <div class="col-md text-center mb-4">
                <img src="https://via.placeholder.com/400" alt="Product Image" class="card-img-top">
            </div>
            <div class="col-md">
                <h2>$prodotto->titolo</h2>
                <p>$prodotto->descrizione</p>
                <h5>Accessori:</h5>
                <ul class="list-group">
                    $formAccessori
                </ul>
                <br>
                <!---->
                <h5>Quantità:</h5>
                <div class="col-md w-25">
                    <input type="number" min="0" value="1" name="quantitativo" class="form-control">
                </div>
                <!---->
                <br>
                <button type="submit" class="btn btn-primary" name="prodotto" value="$prodotto->id">Aggiungi al carrello</button>
            </div> 
        </form>
    HTML;
        ?>
    </main>
    <?php include_once "./components/footer.php"; ?>
</body>

</html>