<?php
    include("include/database.php");
    include("include/fetch_products.php");

    function snake_case($string) {
        $lower_case = strtolower($string);
        $final_string = str_replace(" ", "_", $lower_case);
        return $final_string;
    }

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

    <link rel="stylesheet" href="table.css">
</head>
<body>
    <form id="order_process" method="POST" action="process.php"></form>

    <table>
        <caption><?= $page_title ?></caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Small</th>
                <th>Medium</th>
                <th>Large</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($products as $product) {
                    $product_id = $product["id"];
            ?>
                <tr>
                    <td><?= $product_id ?></td>
                    <td><?= $product["name"] ?></td>

                    <td>
                        <picture>
                            <source srcset="<?= "images/" . snake_case($product["name"]) . ".avif" ?>" type="image/avif">
                            <img src="<?= "images/" . snake_case($product["name"]) . ".jpg" ?>" alt="<?= "Image of " . $product["name"] ?>">
                        </picture>
                    </td>

                    <?php 
                        foreach ($product["prices"] as $key => $value) {
                            if ($value === "Unavailable") {
                    ?>
                        <td class="unavailable">Unavailable</td>
                    <?php } else { ?>
                        <td class="option">
                            <p><?= $value ?></p>
                            <input type="checkbox" name="selected_items[]" value="<?= $product_id ?>_<?= $key ?>" form="order_process">
                        </td>
                    <?php
                            }
                        }
                    ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <section>
        <button onclick="uncheckAll()">Reset</button>
        <button type="submit" form="order_process">Order</button>
    </section>

    <script>
        function uncheckAll() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    </script>
</body>
</html>
