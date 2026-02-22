<?php
    require 'database.php';

    $query = "SELECT * FROM products";
    $result = $conn->query($query);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Convert the PHP array into a JSON string
    echo json_encode($products);
?>