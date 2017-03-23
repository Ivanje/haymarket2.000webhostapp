<?php
    session_start();
    include_once 'formClass.php';
    $email =  $_POST['email'];
    $password = $_POST['password'];
    include 'integralSignIn.php';
    error_reporting(E_ALL ^ E_NOTICE);


    if($_SESSION['email']) {
        $title = "Welcome";
        include 'header.php';
        echo '<div>';
        echo '<h2>Welcome </h2>';
        echo '<p> To go to the homepage click <a href="index.php">here </ahref>';
        echo '</div>';
    } else {
        $title = "Error";
        include 'header.php';
        include_once 'Messages.php';
        Messages::printBadMessage('Your username and/or password was incorrect!!!');
        $form = new Form;
        $form->printForm('mainSignIn.php');
        $form->printNoAccount();
    }
?>