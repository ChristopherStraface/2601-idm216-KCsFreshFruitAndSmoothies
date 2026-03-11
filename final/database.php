<?php
    $env_vars = [
        'DB_SERVER'   => $_SERVER['REDIRECT_DB_SERVER']   ?? $_SERVER['DB_SERVER']   ?? null,
        'DB_USERNAME' => $_SERVER['REDIRECT_DB_USERNAME'] ?? $_SERVER['DB_USERNAME'] ?? null,
        'DB_PASSWORD' => $_SERVER['REDIRECT_DB_PASSWORD'] ?? $_SERVER['DB_PASSWORD'] ?? null,
        'DB_NAME'     => $_SERVER['REDIRECT_DB_NAME']     ?? $_SERVER['DB_NAME']     ?? null
    ];

    if (in_array(null, $env_vars, true))
        die('Missing required environment variables');

    define('DB_SERVER', $env_vars['DB_SERVER']);
    define('DB_USER',   $env_vars['DB_USERNAME']);
    define('DB_PASS',   $env_vars['DB_PASSWORD']);
    define('DB_NAME',   $env_vars['DB_NAME']);

    // Create database connection 
    $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if ($connection->connect_error)
        die("Connection failed: " . $connection->connect_error);

    // Change item name to a snake-case string.
    function snake_case($string) {
        $lower_case = strtolower($string);
        $final_string = str_replace(" ", "_", $lower_case);
        return $final_string;
    }

    function check_existence($input) {
        $input_type = gettype($input);
        if (($input_type === "integer") && ($input !== 0)) {
            // The prices are stored in cents in the database. 
            $price = number_format($input / 100, 2);
            return $price;
        } else {
            // If the input is not 0 or empty, then keep going.
            return null;
        }
    }

    function get_item_info($id, $products) {
        $target_index = array_search($id, array_column($products, 'id'));
        $target_item = $products[$target_index];
        return $target_item;
    }

    function price_list($input_row) {
        $price_list = [
            "small" => check_existence($input_row["small"]),
            "medium" => check_existence($input_row["medium"]),
            "large" => check_existence($input_row["large"])
        ]; 
        return $price_list;
    }

    // Fetch ingredients
    $ingredients = [];
    $stmt_ingredients = $connection->prepare("SELECT * FROM ingredients");
    $stmt_ingredients->execute();
    $result_ingredients = $stmt_ingredients->get_result();
    while ($row_ingredients = $result_ingredients->fetch_assoc()) {
        array_push($ingredients, $row_ingredients["ingredients"]);
    }

    // Fetch add-ons
    $add_ons = [];
    $stmt_add_ons = $connection->prepare("SELECT * FROM add_ons");
    $stmt_add_ons->execute();
    $result_add_ons = $stmt_add_ons->get_result();
    while ($row_add_ons = $result_add_ons->fetch_assoc()) {
        array_push($add_ons, $row_add_ons["add_ons"]);
    }

    // Fetch products
    $products = [];
    $stmt_products = $connection->prepare("SELECT * FROM products WHERE id < 5");
    $stmt_products->execute();
    $result_products = $stmt_products->get_result();

    // Make an associative array to store the product information
    while ($row_products = $result_products->fetch_assoc()) {
        $product = [
            "id" => $row_products["id"],

            "name" => $row_products["name"],
            "image" => snake_case($row_products["name"]) . ".avif",
            "fallback" => snake_case($row_products["name"]) . ".jpg",

            "prices" => price_list($row_products),

            "ingredients" => $row_products["ingredients"] ? $ingredients : [],
            "add_ons" => $row_products["add_ons"] ? $add_ons : [],
        ]; 
        array_push($products,$product);
    }

    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (!isset($_SESSION['subtotal'])) {
        $_SESSION['subtotal'] = 0;
    }
    if (!empty($_POST)) {
        array_push($_SESSION['cart'], $_POST);
        if (!empty($_POST["item_price"])) {
            $_SESSION['subtotal'] += $_POST["item_price"];
        }
    }
?>
