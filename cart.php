<?php 
include 'cartClass.php';
?>



<?php

$cart = new Cart('This cart is awesome');
$cart->header();
$cart->startJumbotron();
$cart->cartSession();
$cart->endJumbotron();
if($_SESSION['email']) {
    include 'showAddress.php';
    include 'paymentForm.php';
}
else {
    echo '<div class="container">';
    echo "<div class='jumbotron'>";
    $cart->signInForm();
    echo '</div">';
    echo "</div>";
}
    
    include 'footer.php';
?>