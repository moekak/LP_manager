<?php

class CommonRequest{
    public static function checkLength($data, $max_length){
        return mb_strlen($data, 'UTF-8') <= $max_length;
    }

    public static function hasValue($data){
        return isset($data) && $data !== "" && $data !== null;
    }
}