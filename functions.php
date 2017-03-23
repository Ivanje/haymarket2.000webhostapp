<?php

class UsefullFunctions  {

    public static function isFilled($array) {

        foreach($array as $key => $value) {
            if(!isset($key) || $value == '' ) {
                return false;
            }
        }
        return true;
    }
}

?>