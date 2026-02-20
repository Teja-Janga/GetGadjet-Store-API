
<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "getgadjet";
    $conn = "";     // Connection Variable

    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

        // To handle special characters correctly
        mysqli_set_charset($conn, "utf8mb4");
    }
    catch(mysqli_sql_exception) {
        die("Could not Connect. Please try again later!");
    }
?>