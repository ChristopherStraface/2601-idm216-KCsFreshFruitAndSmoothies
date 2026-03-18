<?php
    include "./include/database.php";

    $_SESSION["receipt"] = $receipt_default;

    header('Location: ./index.php');
    exit;
?>
