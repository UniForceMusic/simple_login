<?php
    // This function checks if the session id is present in the database
    // HOW IT WORKS:
    // - The script gets all the session id's from the database
    // - It checks if the current session id is present anywhere in the database
    // - If it's present in the database the page is allowed to be displayed
    
    function checkIfSessionIDisPresent($session_id) {
        // This gets the variable for the connection to the database
        include_once 'dbConnect.php';

        // Get all the session id's from the database
        $sql = "SELECT active_session_id FROM users WHERE user_id > 0;";
        $result = mysqli_query($connection, $sql);

        // Store all the active session id's in an array
        while($row = mysqli_fetch_array($result)) {
            $resultArray[] = $row['active_session_id'];
        }

        // Check if the session id is present in the array
        $isPresent = in_array($session_id, $resultArray);

        // Return a boolean value if the session is present
        return $isPresent;
    }
?>