<?php
session_start();
unset($_SESSION["userID"]);
header("Location: ../views/login.php", true, 301);
