<?php

session_start();

require_once('vendor/autoload.php');
require_once('config.php');
require_once('showBooks.php');
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_test_LgrbFBOBlmAsUiqRo2LejCCj");

// Token is created using Stripe.js or Checkout!
// Get the payment token submitted by the form:
$token = $_POST['stripeToken'];

// Token is created using Stripe.js or Checkout!
// Get the payment token submitted by the form:
$token = $_POST['stripeToken'];

try {

// Charge the user's card:
$charge = \Stripe\Charge::create(array(
  "amount" => ($_SESSION['total_price'] * 100),
  "currency" => "eur",
  "description" => "Example charge",
  "source" => $token,
));  
    //$_SESSION['cart'] = array();
  //  $_SESSION['items'] = 0;
 //   $_SESSION['total_price'] = '0.00';
    include 'header.php';
    ?>

    <?php
    
        $conn = Connection::ConnectToDB();
        $conn->autocommit(FALSE);
        $query = "SELECT id, fullname FROM user WHERE mail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $_SESSION['email']);
        $stmt->execute(); 
        $stmt->store_result();
        $stmt->bind_result($id, $fullname);
        if($stmt->fetch()) {
            $userid = $id; //var which will be used letter for the database
            $name = $fullname; // var
        }
        else {
            throw new Exception();
        }
        $date = date('Y-m-d H:i:s'); // var
        $quantity = $_SESSION['items']; // var
        $total_price = $_SESSION['total_price']; // var
    
        
    
        $query = "SELECT address1, address2, town, zipcode, countryid
                  FROM address
                  WHERE address.addressid = ?";
    
        $stmt = $conn->prepare($query);
        $addressid = $_SESSION['addressid'];
        $stmt->bind_param('i', $addressid);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->bind_result($address1, $address2, $town, $zipcode, $country_id) == false ) // $baddress = bindin_address
            echo 'Bindin error';
    
        $stmt->fetch();
    
    
     
        $query = "INSERT INTO orders VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $status = 1;
        $stmt->bind_param("isidsssssiii", $userid, $date, $quantity, 
                          $total_price, $address1, $address2, 
                          $name, $town, $zipcode, 
                          $country_id, $addressid, $status);
       if($stmt->execute() == false) {
           throw new Exception();
       }
        
                // razlikata pomegu momentalnoto vreme i vremeto na naracka ne treba
                // da bide pogolemo od 30 sekundi
       $query = "SELECT orderid FROM orders WHERE
                 TIME_TO_SEC(TIMEDIFF(NOW(), datetime)) < 30 AND 
                 userid = ?";
       $stmt = $conn->prepare($query);
       $stmt->bind_param("i", $userid);
                        
       if(!$stmt->execute()) {
           echo "Greska pri orderid";
       }
       $stmt->store_result();
       $stmt->bind_result($orderid);
       $stmt->store_result();
               
       $query = "INSERT INTO order_book VALUES(?, ?, ?, ?, ?, ?)";
       $stmt = $conn->prepare($query);
       
       $query = "SELECT price, discountrate FROM book
                 where isbn = ?";

    
       $stmt2 = $conn->prepare($query);
    
        foreach($_SESSION['cart'] as $isbn => $qty) {
            
            if($qty == null || $qty == 0)
                continue;
            
   
            $stmt2->bind_param('s', $isbn);
            $stmt2->execute();
            $result = $stmt2->get_result();
            $row = $result->fetch_assoc();
            $final_price = Show::getFinalPrice($row);
           
            if($row['discountrate'] == null)
                $rate = 0;
            else
                $rate = $row['discountrate'];
           
            $stmt->bind_param("isiddd", $orderid, $isbn, $qty, $row['price'], $rate, $final_price);
        }
       $conn->commit();
       $conn->autocommit(TRUE);
    
       $_SESSION['cart'] = array();
       $_SESSION['items'] = 0;
       $_SESSION['total_price'] = '0.00';

    ?>
    
    <div class="container">
        <div class="jumbotron">
            <h1>The transaction went through</h1>
        </div>
    </div>
    <?php
}
catch (Exception $e) {
    echo $e;
}



?>