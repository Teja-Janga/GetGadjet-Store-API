
<?php
    $db_server = "mysql-3a1ea88d-tejat7927-2604.b.aivencloud.com";
    $db_user = "avnadmin";
    $db_pass = "AVNS__N9ORxGkKT8wybBBTgz";
    $db_name = "defaultdb";
    $port = "27293";
    $conn = "";     // Connection Variable

    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name, $port);

        // To handle special characters correctly
        mysqli_set_charset($conn, "utf8mb4");
    }
    catch(mysqli_sql_exception) {
        die("Could not Connect. Please try again later!");
    }
?>