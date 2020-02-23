<!DOCTYPE html>
<meta charset="UTF-8">
<link rel="stylesheet" href="stylesheet.css">

<html>
    <head>
        <title>Log in page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            // This function checks if the login credentials are correct
            function checkLoginCredentials() {
                // Variables that get send to the php script
                var username = $('#username').val();
                var password = $('#password').val();

                // Send username and password to the php script that compares them to the database
                $.post('php/checkLoginCredentials.php', {username:username, password:password}, function(response){
                    // Write the response message in the container
                    $('.databaseresponse').replaceWith(response);
                });
            }

            // This function sends the username and password to a php script that will create the new user
            function createNewUser() {
                // Variables that get send to the php script
                var username = $('#username').val();
                var password = $('#password').val();

                $.post('php/createUser.php',{username:username, password:password}, function(response){
                    $('.databaseresponse').replaceWith(response);
                });
            }
        </script>
    </head>

    <body>
        <div class="inlogcontainer">
            <!-- USERNAME AND PASSWORD INPUT BOXES -->
            <form method="php/checkLoginCredentials.php" action="post">
                <td>Username: <input type="textbox" class="textbox" id="username" name="username" size="16" autocomplete="off" autofocus="autofocus"></td><br>
                <td>Password: <input type="textbox" class="textbox" id="password" name="password" size="16" autocomplete="off"></td><br>
            </form>

            <button onclick="checkLoginCredentials()">Log in</button>
            <button onclick="createNewUser()">Create new user</button>
            
            <!-- DIV THAT CONTAINS THE MESSAGE THE PHP SCRIPT SENDS BACK -->
            <div class="databaseresponse"></div>
        </div>
    </body>
</html>