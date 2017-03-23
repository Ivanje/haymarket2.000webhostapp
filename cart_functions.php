<?php
    include 'config.php';
    include 'showBooks.php';

    function calculate_price($cart) {
        
        
        $price = 0.0;
        if(is_array($cart)) {
            $conn = Connection::connectToDB();
                    
            foreach($cart as $isbn => $qty) {
                $query = "select price, discountrate from book where isbn=?";
                
                if($stmt = $conn->prepare($query)) {
                    $stmt->bind_param('s', $isbn);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $result = $result->fetch_assoc();
                }
                
                
                if($result) {
                    
                    $item_price = Show::getFinalPrice($result);            
    
                    $price += $item_price * $qty;
                }
            }
        }
        return $price;
    }

    function calculate_items($cart) {
        $items = 0;
        if(is_array($cart)) {
            foreach($cart as $isbn => $qty) {
                $items += $qty;
            }
        }
        return $items;
    }



?>