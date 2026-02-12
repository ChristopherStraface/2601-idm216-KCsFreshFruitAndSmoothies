<?php
    $form = [];

    foreach ($products as $product) {
        $form_item = [
            "id" => $product["id"],
            "name" => $product["name"]
        ];

        foreach ($product["prices"] as $key => $value) {
            if ($value !== "Unavailable") {
                $form_item["size"] = $key;
                $form_item["price"] = $value;
                $form_item["count"] = 0;

                $product_code = $product["id"] . "-" . $key;
                $form[$product_code] = $form_item;
            }
        }       
    }
?>
