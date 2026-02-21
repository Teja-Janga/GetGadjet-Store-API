
<?php
    header("Access-Control-Allow-Origin: https://get-gadjet-store-react.vercel.app");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Credentials: true");

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

    try {
        $conn = mysqli_connect($hostname, $username, $password, $database, $port);

        // To handle special characters correctly
        mysqli_set_charset($conn, "utf8mb4");
    }
    catch(mysqli_sql_exception) {
        die("Could not Connect. Please try again later!");
    } 
?> 