<?php
require_once "../models/Ordine.php";

$o=new Ordine();

?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ordini</title>
    <?php include_once "./components/dipendenze.php"; ?>
</head>

<body>
    <header class="d-flex justify-content-center py-2 sticky-top bg-light">
        <ul class="nav nav-pills lead">
            <li class="nav-item"><a href="../index.php" class="nav-link" aria-current="page"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="nav-item"><a href="./carrello.php" class="nav-link"><i class="bi bi-cart-fill"></i></a></li>
            <li class="nav-item"><a href="./profilo.php" class="nav-link"><i class="bi bi-person-circle"></i></a></li>
        </ul>
    </header>
    <main class="container">
        <div class="row my-4">
            <div class="col-6 mx-auto">
                <div class="card p-2">
                    <h5 class="card-title">Ordine Nº{Numero}</h5>
                    <div class="card-text">
                        <ul>
                            <li class="w-75">
                                <div class="d-flex justify-content-between">
                                    <span>{N} x {item}</span>
                                    <span class="text-end">13 €</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>