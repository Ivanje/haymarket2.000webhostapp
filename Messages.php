<?php

    class Messages {
        
        public static function printBadMessage($message) {
            echo '<div class="alert alert-danger message">';
            echo '<p>' . $message . '</p>';
            echo '</div>';
        } 
        
        public static function printSuccess($message) {
            echo '<div class="alert alert-success message">';
            echo '<p>' . $message . '</p>';
            echo '</div>';
        }
    }


?>
