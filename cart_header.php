<?php
    require 'cart_functions.php';

        session_start();

    $new = $_GET['new'];
    if(isset($_GET['qty'])) // ako qty e pratena, togas znaci deka se menuva kolicinata preku kolickata
        $qty = $_GET['qty'];
    else
        $qty = 1;

    if($qty < 0 || $qty > 10)
        exit;

    if($new) {
        
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
            $_SESSION['items'] = 0;
            $_SESSION['total_price'] = '0.00';
        }
        
        if(isset($_SESSION['cart'][$new])) {
            if(!isset($_GET['qty']))
                $_SESSION['cart'][$new] = $_SESSION['cart'][$new] + 1 ;
            else
                $_SESSION['cart'][$new] = $qty;
        } else {
            $_SESSION['cart'][$new] = 1;
        }
        
        $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
        $_SESSION['items'] = calculate_items($_SESSION['cart']);
        
        echo $_SESSION['total_price'] . ';'; // ; funkcionira kako delimiter
        echo $_SESSION['items'];
    }



?>