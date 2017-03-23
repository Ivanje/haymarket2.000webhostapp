<?php   
    require_once'config.php';
    $db = Connection::connectToDB();

    error_reporting(E_ALL ^ E_NOTICE);

    $query = "SELECT password FROM USER WHERE mail = ?";

    if(($stmt = $db->prepare($query)) == false)
        die("We got an error". $db->error);

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($pass);

    if($stmt->fetch()) {
        $databasePassword = $pass;
    }
    
    if(password_verify($password, $databasePassword)) {
        $_SESSION['email'] = $email;
    }

?>