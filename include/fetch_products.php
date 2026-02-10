<?php
    // If adding lemonade and water, remove the constraint
    $stmt_products = $connection->prepare("SELECT * FROM products WHERE id < 5");
    $stmt_products->execute();
    $result_products = $stmt_products->get_result();

    $stmt_ingredients = $connection->prepare("SELECT * FROM ingredients");
    $stmt_ingredients->execute();
    $result_ingredients = $stmt_ingredients->get_result();
    $ingredients = [];
    while ($row_ingredients = $result_ingredients->fetch_assoc()) {
        array_push($ingredients, $row_ingredients["ingredients"]);
    }

    $stmt_add_ons = $connection->prepare("SELECT * FROM add_ons");
    $stmt_add_ons->execute();
    $result_add_ons = $stmt_add_ons->get_result();
    $add_ons = [];
    while ($row_add_ons = $result_add_ons->fetch_assoc()) {
        array_push($add_ons, $row_add_ons["add_ons"]);
    }

    function product_existence($price) {
        return $price ? number_format($price/100, 2) : "Unavailable";
    }

    function price_list($one_size, $small, $medium, $large) {
        if ($one_size === 0) {
            $list = [
                "small" => product_existence($small),
                "medium" => product_existence($medium),
                "large" => product_existence($large)
            ]; 
        } else {
            $list = ["one_size" => product_existence($one_size)];
        }
        return $list;
    }

    $products = [];

    while ($row_products = $result_products->fetch_assoc()) {
        $product = [
            "id" => $row_products["id"],
            "name" => $row_products["name"],

            "prices" => price_list($row_products["one_size"], $row_products["small"], $row_products["medium"], $row_products["large"]),

            "ingredients" => $row_products["ingredients"] ? $ingredients : "Unavailable",
            "add_ons" => $row_products["add_ons"] ? $add_ons : "Unavailable"
        ]; 
        array_push($products, $product);
    }
?>
