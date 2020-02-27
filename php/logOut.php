<?php
    // HOW IT WORKS:
    // - The session id is sent to the database
    // - All the user id's that match are cleared from the database

    // Disable error loggin
    error_reporting(0);

    // This gets the variable for the connection to the database
    include_once 'dbConnect.php';

    // Variable that stores the session id
    session_start();
    $session_id = session_id();

    // Clear all the active_session_id's that match this one
    $sql = "UPDATE users SET active_session_id='NULL' WHERE active_session_id LIKE '$session_id';";
    mysqli_query($connection, $sql);
?>