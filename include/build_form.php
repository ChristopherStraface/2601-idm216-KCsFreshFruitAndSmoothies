<?php
    $form = [];

    foreach ($products as $product) {
        $product_id = $product["id"];

        $form_item = ["name" => $product["name"]];

        foreach ($product["prices"] as $key => $value) {
            $type = $product_id . "_" . $key;

            if ($value !== "Unavailable") {
                $form_item["price"] = $value;
                $form_item["count"] = 0;

                $form[$type] = $form_item;
            }
        }       
    }
?>
