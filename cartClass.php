<?php

class Cart {
        
    private $conn;
    private $title;
        
    function __construct($title) {
        require_once 'config.php';
        require_once 'showBooks.php';
        $this->conn = Connection::connectToDB();
        $this->title = $title;
    }
    
    
    function isConnEmpty() {
        return $this->conn == null;
    }
    
    function isCartEmpty() {
        return !isset($_SESSION['cart']);
    }
        
    function header() {
        include 'header.php';
    }
 
    function startJumbotron() {
        echo '<div class="container">';
        echo "<div class='jumbotron cart'>";
        echo '<h1>Your basket</h1>';
    }
        
    function cartSession() {
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $isbn => $qty) {
                if($qty == 0) // pri brisenje $qty stanuva eden
                    continue;
                $query = 'select title, format, price, discountrate from
                book where isbn=' . $isbn;
                $result = $this->conn->query($query);
                if($result) {
                     $item = $result->fetch_array();
                     echo '<div id="' . $isbn . '" class="bookCart">';
                     echo '<img id="cartImage" src="img/smallImg/'. $isbn . '.jpg">'; 
                     echo '<h2>' . $item['title'] . '</h2>';
                     echo '<p><span class="boldSpan">' . 'Price : </span>' . Show::getFinalPrice($item) . "\xE2\x82\xAc" .  '</p>';
                     echo '<p><span class="boldSpan">' . $item['format'] . '</span></p>';
                     echo '<p><span class="boldSpan">' . "Quantity: </span>";
                     echo '<select id="selectQuantity">';
                     for($i = 1; $i <=10; $i++) {
                         if($qty == $i)
                             echo "<option selected value='" . $i . "'>" . $i . "</option>";
                         else
                            echo "<option class='quantityOption' value='" . $i . "'>" . $i . "</option>";
                     }
                     echo '</select>';
                     echo '<button class="stylishButton removeBook" name="removeBook">Remove</button>';
                     echo '<div class="clearDiv"></div>';
                     echo '</div>';
                    }
                }
        }
        else 
            echo '<h3>Basket is empty</h3>';     
    }

    function endJumbotron() {
        echo "<div class='clearDiv'></div>";
        echo "</div>";
        echo "</div>";
    }

    function SignInForm() { 
        include_once 'formClass.php';
        $form = new Form();
        $form->printForm('SignIn.php');
        $form->printNoAccount();
    }

    function footer() {
        include 'footer.php';
    }
} // end of class Cart
?>
