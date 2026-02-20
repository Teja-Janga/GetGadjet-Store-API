
<?php
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