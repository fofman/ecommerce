<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require "../models/Utente.php";

    list($user, $pw) = array_values($_POST);
    $u = new Utente();
    if ($u->login($user, $pw) == 0) {//SE FUNZIONA
        session_start();//INIZIO LA SESSIONE
        $_SESSION["userID"] = $u->getID($user);
        header("Location: ../index.php", TRUE, 301);
    }else{
        header("Location: ../views/login.php", TRUE, 301);
    }

    exit();
}
?>