<?php
    ob_start();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    // Handle Preflight (OPTIONS) requests immediately
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }
    
    $hostname = getenv('DB_HOST') ?: ''; 
    $username = getenv('DB_USER') ?: '';
    $password = getenv('DB_PASS') ?: '';
    $database = getenv('DB_NAME') ?: 'defaultdb';
    $port     = getenv('DB_PORT') ?: '27293';

    $conn = mysqli_connect($hostname, $username, $password, $database, $port);

    if (!$conn) {
        // If it fails, we STILL need to send JSON so React doesn't crash
        header('Content-Type: application/json');
        die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
    }
        
        // To handle special characters correctly
    mysqli_set_charset($conn, "utf8mb4");
    
     
