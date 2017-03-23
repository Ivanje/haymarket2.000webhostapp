<?php
    require_once 'config.php';
    require_once 'functions.php';

    session_start();

    $fullName = trim($_POST['fullName']);
    $password1 = ($_POST['password1']);
    $password2 = ($_POST['password2']);
    $email = trim($_POST['email']);

    if(!UsefullFunctions::isFilled($_POST)) {
        $_SESSION['error']['notFilled'] = "All field are compulsory.";
                header("Location: http://localhost:3456/books/registerForm.php");
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        $_SESSION['error']['email'] = "It seems like your email is invalid";
    
    if($password1 != $password2)
        $_SESSION['error']['mismatch'] = "Passwords didn't match";

    if(strlen($password1) < 6)
        $_SESSION['error']['minpass'] = "Minimum password length is 6 characters";

    $connection = Connection::connectToDB();
    
    if(count($_SESSION['error']) == 0) {
        $sql = "SELECT * FROM user where mail = ?";

        if(($stmt = $connection->prepare($sql)) == false) 
            $_SESSION['error']['database'] = "Database error";
        else {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->fetch())
                $_SESSION['error']['usedEmail'] = "Your email is already used.";
        }
    }




    $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);



    $connection2 = Connection::connectToDB();
    $sql2 = "INSERT INTO USER VALUES(NULL, ?, ?, ?, ?, NULL)";
    if(($stmt2 = $connection2->prepare($sql2)) == false)
        $_SESSION['error']['database'] = "Database connection error.";
        
    $date = date('Y-m-d H:i:s');

    if(count($_SESSION['error']) == 0){
        $stmt2->bind_param('ssss', $email, $hashedPassword, $fullName, $date);
        $stmt2->execute();
        if($stmt2->affected_rows > 0) {
            include 'header.php';
            echo '<div class="container">';
            echo '<div class="jumbotron">';
            echo '<h2>You were succefull registered.</h2>';
        }
        else
            $_SESSION['error']['insertion'] = 'Unknown error. Try again letter';
                
    } else {

    }
?>