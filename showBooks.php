<?php
class Show {
    public static function showBooks($result) {
        echo '<div class="booksResult">';

        while($row = $result->fetch_assoc()) {
            echo '<div class="bookBox">';
            echo "<img src='img/smallImg/" . $row['isbn']. ".jpg'>";
            echo "<div class='bookTitle'>" . '<p>' . $row['title'] . '</p>' . '</div>';
            Show::showPrice($row);
            echo '</div>';
        }
        echo '</div>'; // booksResult
    }
    
    public static function showPrice($row) {
        $price = $row['price'];
        $finalPrice = Show::getFinalPrice($row);
        if($price == $finalPrice)
            echo "<span class='price'>". $price .  "\xE2\x82\xAc" . "</span>";
        else {
            echo "<span class='price'>". $finalPrice . 
                  "\xE2\x82\xAc" . "</span>";
            echo "<span class='previousPrice'>". $price .  "\xE2\x82\xAc" . "</span>";
        }
    }
    
    public static function getFinalPrice($row) {
        $price = $row['price'];
        $discountrate = $row['discountrate'];
        if($discountrate == null || $discountrate == 0)
            return $price;
        else {
            $finalPrice = $price - $price * ($discountrate / 100.0);
            $finalPrice = number_format($finalPrice, 2);
            return $finalPrice;
        }
    }
    
}

?>