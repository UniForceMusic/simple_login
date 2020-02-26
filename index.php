<?php
    // HOW IT WORKS:
    // - A session is started
    // - The page calls a script that checks if the session id is present in the database
    // - If the session id is present the user is allowed to enter the site
    // - If the session id is not present the user is redirected to the login page

    // Include the file that contains the script
    include_once 'php/checkSessionID.php';

    // Start a session
    session_start();

    // If the session id is not present direct the user to the login page
    if (!checkIfSessionIDisPresent(session_id())) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<link rel="stylesheet" href="stylesheet.css">

<html>
    <head>
        <title>Log in page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            // Function that gets the username to display
            function getUsername() {
                $.post('php/getUsername.php', {}, function(username){
                    // Write the response message in the value
                    document.getElementById("displayname").innerHTML = username;
                });
            }

            // Function that logs the user out
            function logOut() {
                $.post('php/logOut.php', {}, function(response){
                    window.location.href = "login.php";
                });
            }
        </script>
    </head>

    <body>
        <div class="welcome message">
            <td><p id="displayname">NULL</p><td>
        </div>

        <button onclick="logOut()">Log out</button>
    </body>

    <script>
        window.onload = getUsername();
    </script>
</html>