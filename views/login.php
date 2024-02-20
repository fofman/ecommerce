<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include "./components/dipendenze.php" ?>
</head>

<body class="align-items-center py-4">
    <main class="w-100 m-auto" style="max-width: 330px;padding: 1rem;">
        <form action="../controllers/login.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Login</h1>

            <div class="form-floating mb-3">
                <input class="form-control" id="floatingInput" name="user">
                <label for="floatingInput">Nome utente</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="pw">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
        </form>
    </main>
</body>

</html>

<!--
    <form action="../controllers/login.php" method="post">
        <input type="text" name="user" placeholder="Nome utente">
        <input type="text" name="pw" placeholder="Password">
        <input type="submit" value="Invia">
    </form>
-->