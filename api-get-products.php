<?php
    // Allow React (localhost:5173) to access this data

    require 'database.php';
    // api_products.php

    $query = "SELECT * FROM products";
    $result = $conn->query($query);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Convert the PHP array into a JSON string
    echo json_encode($products);
?>