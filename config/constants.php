<?php
    //start session
    session_start();
    

    //create constants to store non repeating values
    define('SITEURL', 'http://localhost/mid-term-project/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'usiu-marketplace');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database

?>