<?php
    // Disable error loggin
    error_reporting(0);
    
    // This gets the variable for the connection to the database
    include_once 'dbConnect.php';

    // This gets the username and password from the page the php script was called from
    $username = $_POST["username"];
    $password = $_POST["password"];

    // This function checks if the user is already present in the database
    function checkIfUserAlreadyExist($connection, $username) {
        $sql = "SELECT COUNT(username) FROM users WHERE username='$username';";
        $result = mysqli_query($connection, $sql);
        $resultArray = mysqli_fetch_assoc($result);
        if ($resultArray['COUNT(username)'] == 0) {
            return False;
        } else {
            return True;
        }
    }

    // This function inserts the new username and password in the database
    function insertUserInDb($connection, $username, $password) {
        $sql = "INSERT INTO users(username, password) VALUES('$username', '$password');";
        mysqli_query($connection, $sql);
    }

    // This will check if the password meets the requirements
    // responseMsg will be sent back to the webpage
    // Requirements:
    // - atleast one capital letter
    // - atleast one number
    // - Atleast one special character

    // Check if username is available
    if (!checkIfUserAlreadyExist($connection, $username)) {
        // Check for capital letter
        if (preg_match('/[A-Z]/', $password)) {
            // Check for number
            if (preg_match('/[0-9]/', $password)) {
                // Check for special character
                if (preg_match('/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
                    $responseMsg = "User: " . $username . " succesfully created";

                    // This calls the function that inserts the new user in the database
                    insertUserInDb($connection, $username, $password); 
                } else {
                    $responseMsg = "Must atleast contain one special character";
                }
            } else {
                $responseMsg = "Must atleast contain one numeric character";
            }
        } else {
        $responseMsg = "Must atleast contain one capital letter";
        }
    } else {
        $responseMsg = "Username is already taken";
    }
    

    // This lets the user know the operation completed succesfully
    echo "<div class=\"databaseresponse\">" . $responseMsg . "</div>";
?>