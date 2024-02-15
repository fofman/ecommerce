<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require "../models/Utente.php";

    list($user, $pw) = array_values($_POST);
    $u = new Utente();
    echo $u->creaUtente($user, $pw);
    exit();
}
