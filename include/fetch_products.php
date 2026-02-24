<?php
    // This program can only be used after "database.php".

    // Change item name to a snake-case string.
    function snake_case($string) {
        $lower_case = strtolower($string);
        $final_string = str_replace(" ", "_", $lower_case);
        return $final_string;
    }

    // Set up arrays to contain data fetched from the database.
    $ingredients = [];
    $add_ons = [];
    $products = [];

    // If adding lemonade and water, remove the constraint.
    $stmt_products = $connection->prepare("SELECT * FROM products WHERE id < 5");
    $stmt_products->execute();
    $result_products = $stmt_products->get_result();

    $stmt_ingredients = $connection->prepare("SELECT * FROM ingredients");
    $stmt_ingredients->execute();
    $result_ingredients = $stmt_ingredients->get_result();
    while ($row_ingredients = $result_ingredients->fetch_assoc()) {
        array_push($ingredients, $row_ingredients["ingredients"]);
    }

    $stmt_add_ons = $connection->prepare("SELECT * FROM add_ons");
    $stmt_add_ons->execute();
    $result_add_ons = $stmt_add_ons->get_result();
    while ($row_add_ons = $result_add_ons->fetch_assoc()) {
        array_push($add_ons, $row_add_ons["add_ons"]);
    }

    function check_existence($input) {
        $input_type = gettype($input);
        if (($input_type === "integer") && ($input !== 0)) {
            // The prices are stored in cents in the database. 
            $price = number_format($input / 100, 2);
            return $price;
        } else {
            // If the input is not 0 or empty, then keep going.
            return $input ?: "Unavailable";
        }
    }

    function price_list($one_size, $small, $medium, $large) {
        if ($one_size) {
            // If the one-size option is not 0, then only return that.
            $price_list = ["one_size" => check_existence($one_size)];
        } else {
            $price_list = [
                "small" => check_existence($small),
                "medium" => check_existence($medium),
                "large" => check_existence($large)
            ]; 
        }
        return $price_list;
    }

    function fetch_items($input, $type) {
        // When there are available items, fetch content from arrays.
        if ($input) {
            $items_array = [];
            foreach ($type as $category) {
                $items_array[$category] = false;
            }
            return $items_array;
        } else {
            return "Unavailable";
        }
    }

    while ($row_products = $result_products->fetch_assoc()) {
        $product = [
            "id" => $row_products["id"],

            "name" => $row_products["name"],
            "image" => snake_case($row_products["name"]) . ".avif",
            "fallback" => snake_case($row_products["name"]) . ".jpg",

            "prices" => price_list($row_products["one_size"], $row_products["small"], $row_products["medium"], $row_products["large"]),

            "ingredients" => fetch_items($row_products["ingredients"], $ingredients),
            "add_ons" => fetch_items($row_products["add_ons"], $add_ons)
        ]; 
        array_push($products, $product);
    }
?>
