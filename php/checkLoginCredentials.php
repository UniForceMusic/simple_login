<?php
    // HOW IT WORKS:
    // - The script gets the username and password via POST
    // - The script gets the password that belongs to the given username from the database
    // - It compares the passwords
    // - If the passwords match a redirect is injected in in the page
    // - If the password doesn't match the user is notified
    // - The variable respondeMsg is responsible for containing the message that will be sent back to the webpage
    // - I send back a div so it's easier to style with css

    // Disable error loggin
    error_reporting(0);

    // This gets the variable for the connection to the database
    include_once 'dbConnect.php';

    // This gets the username and password from the page the php script was called from
    $username = $_POST["username"];
    $password = $_POST["password"];

    // This function gets the password from the specified user from the database
    function getPasswordFromUser($connection, $username) {
        $sql = "SELECT * FROM users WHERE username LIKE '$username';";
        $result = mysqli_query($connection, $sql);
        $resultArray = mysqli_fetch_assoc($result);
        return $resultArray['password'];
    }

    // Function that sets the current user ID as the active user ID
    function setActiveSessionID($connection, $username) {
        session_start();
        $session_id = session_id();

        // Clear all the active_session_id's that match this one
        $sql = "UPDATE users SET active_session_id='NULL' WHERE active_session_id LIKE '$session_id';";
        mysqli_query($connection, $sql);

        // Update the active_session_id of the given username
        $sql = "UPDATE users SET active_session_id='$session_id' WHERE username LIKE '$username';";
        mysqli_query($connection, $sql);
    }

    // This function compares the password the user gave to the password in the database
    function comparePassword($connection, $username, $password, $storedPassword) {
        if ($password == $storedPassword) {
            // Set the current session id as active for this username
            setActiveSessionID($connection, $username);

            // Return this to the website and redirect the user to the homepage
            return "<script> window.location.href = \"index.php\"; </script>";
        } else {
            // Return this to the website
            return "Password is incorrect";
        }
    }

    // Message that will be sent back to the webpage in a div
    $responseMsg = comparePassword($connection, $username, $password, getPasswordFromUser($connection, $username));

    // This variable is the response code that gets sent back to the webpage
    $responeDiv = "<div class=\"databaseresponse\">" . $responseMsg . "</div>";

    // This sends the div back to the webpage
    echo $responeDiv;
?>