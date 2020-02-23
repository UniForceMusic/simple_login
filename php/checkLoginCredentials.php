<?php
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

    // This function compares the password the user gave to the password in the database
    function comparePassword($password, $storedPassword) {
        if ($password == $storedPassword) {
            return "Password is correct";
        } else {
            return "Password is incorrect";
        }
    }

    // Message that will be sent back to the webpage in a div
    $responseMsg = comparePassword($password, getPasswordFromUser($connection, $username));

    // This variable is the responde code that gets sent back to the webpage
    $responeDiv = "<div class=\"databaseresponse\">" . $responseMsg . "</div>";

    // This sends the div back to the webpage 
    echo $responeDiv;
?>