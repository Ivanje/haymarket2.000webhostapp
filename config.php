<?php


class Connection {
   

public static function connectToDB() {
    
    $db = new mysqli('localhost', 'root', 'lozinka', 'haymarket', 3307);
    if(mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database. <br/> Please try again letter. </p>';
        exit;
    }
    return $db;
    }
}
?>