<?php

class Validation
{
    public function validation($str, $len){
        if(!empty($str) and strlen($str) < $len){
            return true;
        }else{
            return false;
        }
    }
    public function valid_number($number, $len){
        if (!empty($number) and is_numeric($number) and strlen($number) < $len) {
            return true;
        }else{
            return false;
        }
    }
}