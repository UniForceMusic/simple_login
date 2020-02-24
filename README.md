# Simple Login
This project is a page where you can create new users and log in

# How To Install
- Install Xampp
- Drop all files/folders in the htdocs folder
- Create database named: login_page
- Import the database with the sql file via phpmyadmin
- Go to localhost

# How it works
- The credentials you fill in "username" and "password" get sent to a PHP script
- Based on the input the PHP script sends a reponse
- The reponse is displayed in the div "databaseresponse"

# TODO
- Automaticly hash the password when saving to the database
- Add cookies
- Add sessions
- Add a config file where you can specify the password requirements

