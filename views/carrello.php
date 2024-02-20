<?php
session_start();
require_once "../models/Prodotto.php";
require_once "../models/Carrello.php";
$p = new Prodotto();
$c = new Carrello();
if (empty($_SESSION["userID"])) {
    echo "entra";
    header("Location: ./login.php", true, 301);
}
$carrello = $c->getOggettiByUtente($_SESSION["userID"]);

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello</title>
    <?php include "./components/dipendenze.php" ?>
    <link rel="stylesheet" href="../public/static/carrello/style.css">
</head>

<body>
    <header class="d-flex justify-content-center py-2 sticky-top bg-light ">
        <ul class="nav nav-pills lead">
            <li class="nav-item"><a href="../index.php" class="nav-link"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page"><i class="bi bi-cart-fill"></i></a></li>
            <li class="nav-item"><a href="./profilo.php" class="nav-link"><i class="bi bi-person-circle"></i></a></li>
        </ul>
    </header>
    <main>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Checkout</h2>
                </div>
                <div class="card-body">
                    <h4>Totale: <?php echo $c->getCosto($_SESSION["userID"])->totale ?> €</h4>
                    <br>
                    <a href="../controllers/checkout.php" class="btn btn-primary">Conferma ordine</a>
                </div>
            </div>
        </div>
        <div class="container mt-5 row mx-auto">
            <?php foreach ($carrello as $item) {
                $prodotto=$p->getByID($item->id_prodotto);
                $prezzo=$prodotto->prezzo*$item->quantitativo;
                echo <<<HTML
            <div class="col-lg-3 col-md-5 mb-4 d-flex align-items-stretch flex-md-fill flex-lg-grow-0">
                <div class="card overflow-hidden flex-fill">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Furniture 1">
                    <div class="card-body">
                        <h5 class="card-title">$prodotto->titolo</h5>
                        <div class="card-text">Prezzo: $prezzo €</div>
                        <div class="card-text">Unità: $item->quantitativo</div>
                        <br>
                        <div class="row">
                            <a href="../views/prodotto.php?prodotto=$prodotto->id" class="col btn btn-primary m-1">
                                <i class="bi bi-arrow-90deg-left"></i>
                            </a>
                            <a href="../controllers/rimuoviDaCarrello.php?item=$item->id" data-method="delete" class="col btn btn-danger m-1">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
            } ?>
        </div>
    </main>
    <?php include "./components/footer.php" ?>
</body>

</html>