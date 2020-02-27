<?php
    // This file contains the variables that are used to connect to the database

    // Disable error loggin
    error_reporting(0);

    // Login variables
    $dbServer = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "login_page";

    /* Connection variable */
    $connection = mysqli_connect($dbServer, $dbUsername, $dbPassword, $dbName);
?>