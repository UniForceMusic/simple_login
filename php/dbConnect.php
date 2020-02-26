<?php
    // This file contains the variables that are used to connect to the database

    // Login variables
    $dbServer = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "login_page";

    /* Connection variable */
    $connection = mysqli_connect($dbServer, $dbUsername, $dbPassword, $dbName);
?>