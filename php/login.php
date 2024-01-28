<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "database.php";
    list($user, $pw) = array_values($_POST);

    $conn = new Connessione();
    echo $conn->login($user, $pw);

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form action="" method="post">
        <input type="text" name="user" placeholder="Nome utente">
        <input type="text" name="pw" placeholder="Password">
        <input type="submit" value="Invia">
    </form>
</body>
</html>