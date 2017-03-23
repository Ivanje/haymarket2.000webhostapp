<?php

    if(session_status() == PHP_SESSION_NONE) {
       session_start();
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo "$title" ?></title>
    
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script src="js/jquery-3.1.1.min.js"></script>
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link  href="css/jquery.fancybox.css" media="screen and (max-width:480px)" rel="stylesheet">
<script src="js/jquery.fancybox.js"></script>

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- JavaScript -->
<script src="//cdn.jsdelivr.net/alertifyjs/1.9.0/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/bootstrap.min.css"/>

<!-- 
    RTL version
-->
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/alertify.rtl.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/default.rtl.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/semantic.rtl.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.9.0/css/themes/bootstrap.rtl.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/max480.css" media="screen and (max-width:480px)">
        <script src="js/script.js"></script>
    
    </head>
<body>
    <div id="frameDiv">
    <div id="navigation">
        <div id="searchForm">
            <a href="index.php "><img id="logo" src="img/logo.png"></a>
            <input type="text" id="searchRequest" name="searchRequest" placeholder="Search for books by keyword / title / author / ISBN">
            <button type="button" id="searchSubmitButton" class="stylishButton">Search</button>
        </div>
    </div>
    <div id="cartHeader">
        <?php
    
           error_reporting(E_ALL & ~E_NOTICE); // Dava greska Notice: Undefined index
    
              if(!$_SESSION['items']) {
                  $_SESSION['items'] = '0';
              }
        
              if(!$_SESSION['total_price']) {
                 $_SESSION['total_price'] = '0.00';
              }
        echo '<div id="priceItemDiv">';                      
        echo "<div id='price'>" . "<img src='img/shopping-cart.png' id='cartLogo'>" . $_SESSION['total_price'] . "\xE2\x82\xAc" . "</div>"; //"\xE2\x82\xAc" - oznaka za evro
        echo "<div id='item'>" . $_SESSION['items'] . "</div>";
        if(!$_SESSION['email'])
            echo '<span id="signIn">Sign In/Register</span>';
        else
            echo '<span id="signOut">Sign Out</span>';
        echo "<div style='clear:both'></div>";
        echo '</div>';
        ?>
    </div>
    <div id="mainPage">


    