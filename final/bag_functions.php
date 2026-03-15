<?php
    include './database.php';

    // If there is any data coming from the previous page
    if (!empty($_POST)) {
        // Add the item to the cart
        array_push($_SESSION['cart'], $_POST);
    }

    // Handle remove from cart
    if (isset($_GET['remove'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            // The GET superglobal is always a string
            if ($index == $_GET['remove']) {
                // Remove item from the cart
                unset($_SESSION['cart'][$index]);
                break;
            }
        }
    }

    // Update item counts
    if (isset($_GET['index']) && isset($_GET['action'])) {
        // Assign more straighforward variables
        $index = $_GET['index'];
        $action = $_GET['action'];

        // Find the specific item in the cart
        if (isset($_SESSION['cart'][$index])) {
            if ($action === "plus") {
                $_SESSION['cart'][$index]["count"] += 1;
            } elseif ($action === "minus" && $_SESSION['cart'][$index]["count"] > 1) {
                // If the count is 1, prohibit the decrease action
                $_SESSION['cart'][$index]["count"] -= 1;
            }
        }
    }

    // Re-index the cart after removing some content
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // Go to the cart page
    header('Location: ./bag.php');
    exit;
?>
