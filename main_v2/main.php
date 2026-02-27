<?php
    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $cart_count = count($_SESSION['cart']);

    include("../include/database.php");
    include("../include/fetch_products.php");

    $page_title = "KC's - Main Menu Items";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./table.css">
</head>
<body>
    <form 
        id="selection" 
        method="get" 
        action="customize.php">
    </form>

    <h1><?= $page_title ?></h1>

    <table>
        <caption>Select the Product You Want</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody><?php 
            foreach ($products as $product) { ?>
                <tr>
                    <td><?= $product["id"] ?></td>
                    <td><?= $product["name"] ?></td>
                    
                    <!-- Cell that contains the product image -->
                    <td><picture>
                        <source 
                            srcset="../images/<?= $product["image"] ?>" 
                            type="image/avif"
                        >

                        <img 
                            src="../images/<?= $product["fallback"] ?>" 
                            alt="Image of <?= $product["name"] ?>"
                        >
                    </picture></td>

                    <td>
                        <input 
                            type="radio"
                            name="product_id"
                            value="<?= $product["id"] ?>"
                            form="selection">
                    </td>
                </tr><?php 
            } ?>
        </tbody>
    </table>

    <section class="buttons">
        <button type="reset">Reset</button>
        <button type="submit" form="selection">Customize</button>
        <a href="./process.php" class="btn">Cart (<?= $cart_count ?>)</a>
    </section>
</body>
</html>
