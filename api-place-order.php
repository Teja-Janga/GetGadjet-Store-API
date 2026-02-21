<?php
    // 1. Handle CORS Preflight immediately
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    require 'database.php';
    ini_set('display_errors', 0); 

    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        $customerName = $data['customerName'];
        $address = $data['address'];
        $phone = $data['phone'];
        $cart = $data['cart'];
        $userId = isset($data['userId']) ? $data['userId'] : 1;
        $sessionId = bin2hex(random_bytes(16)); // Generate a dummy session ID to satisfy the DB

        // 2. Updated INSERT to include Session_id (since your DB requires it)
        $stmt = $conn->prepare("INSERT INTO orders (Session_id, Customer_Name, Address, Phone, User_ID, Status) VALUES (?, ?, ?, ?, ?, 'Pending')");
        $stmt->bind_param("ssssi", $sessionId, $customerName, $address, $phone, $userId);

        if($stmt->execute()) {
            $orderId = $conn->insert_id; 

            $stmtItem = $conn->prepare("INSERT INTO order_items (Order_id, Product_id, Quantity, Price) VALUES (?, ?, ?, ?)");

            foreach ($cart as $item) {
                $pId = $item['ID'];
                $pQty = $item['qty'];
                $pPrice = isset($item['Price']) ? $item['Price'] : 0;
                $stmtItem->bind_param("iiid", $orderId, $pId, $pQty, $pPrice);
                $stmtItem->execute();
            }
            echo json_encode(["status" => "success", "message" => "Order #$orderId placed!", "orderId" => $orderId]);
        } 
        else {
            echo json_encode(["status" => "error", "message" => "Order failed: ". $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No data received"]);
    }
?>