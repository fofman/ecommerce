<?php
session_start();
require_once "../models/Utente.php";
$u = new Utente();
if (empty($_SESSION["userID"])) {
    echo "entra";
    header("Location: ./login.php", true, 301);
}
$utente = $u->getUser($_SESSION["userID"])
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo</title>
    <?php include_once "./components/dipendenze.php"; ?>
</head>

<body>
    <header class="d-flex justify-content-center py-2 sticky-top bg-light ">
        <ul class="nav nav-pills lead">
            <li class="nav-item"><a href="../index.php" class="nav-link"><i class="bi bi-house-door-fill"></i></a></li>
            <li class="nav-item"><a href="./carrello.php" class="nav-link"><i class="bi bi-cart-fill"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page"><i class="bi bi-person-circle"></i></a></li>
        </ul>
    </header>
    <main class="m-2">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Dettagli Profilo Utente</h5>
                            <p class="card-text">ID Utente: <?php echo $_SESSION["userID"] ?></p>
                            <p class="card-text">Nome Utente: <?php echo $utente ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="../controllers/logout.php" class="btn btn-primary">Logout</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <a href="./ordini.php">Cronologia ordini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>