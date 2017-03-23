<?php
    
    session_start();

    error_reporting(0);
    require_once 'cartClass.php';
    require_once 'config.php';
    include_once 'Messages.php';

    $email =  $_POST['email'];
    $password = $_POST['password'];

    include 'integralSignIn.php';

    if(isset($_SESSION['email'])) {
        $cart2 = new Cart('Great');
        $cart2->header();
        $cart2->startJumbotron();
        $cart2->cartSession();
        $cart2->endJumbotron();
        Messages::printSuccess("You logged in");
        include 'showAddress.php';
        include 'paymentForm.php';
    }
    else {
        $cart2 = new Cart('Error');
        $cart2->header();
        $cart2->startJumbotron();
        $cart2->cartSession();
        $cart2->endJumbotron();
        echo '<div class="container">';
        Messages::printBadMessage("Incorrect user and/or password!!!");
        echo '</div>';
        echo '<div class="container">';
        echo '<div class="jumbotron">';
        $cart2->signInForm();
        echo '</div>';
        echo '</div">';
    }
    include 'footer.php';

?>