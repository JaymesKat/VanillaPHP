<?php
namespace VanillaPHP\Helpers;

class Validator {

    public static function check_name($name){
        return preg_match("/^[a-zA-Z ]*$/",$name);
    }

    public static function check_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
