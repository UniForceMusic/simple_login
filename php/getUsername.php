<?php
    // HOW IT WORKS:
    // - The session id is sent to the database
    // - The username with the same session id is retrieved from the database
    // - The script sends the username back

    // This gets the variable for the connection to the database
    include_once 'dbConnect.php';

    // Variable that stores the session id
    session_start();
    $session_id = session_id();

    // Query to get the username assosiated with the session id
    function getUsernameByID($connection, $session_id) {
        $sql = "SELECT * FROM users WHERE active_session_id LIKE '$session_id';";
        $result = mysqli_query($connection, $sql);
        $resultArray = mysqli_fetch_assoc($result);
        return $resultArray['username'];
    }

    echo getUsernameByID($connection, $session_id);
?>