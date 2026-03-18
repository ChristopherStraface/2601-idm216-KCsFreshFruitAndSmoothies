<?php
    // Initiate a session
    session_start();
    // Remove all stored information in the session
    session_destroy();
    // Return to homepage
    header('Location: ./index.php');
    exit;
?>
