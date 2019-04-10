<?php
namespace VanillaPHP\Helpers;

class AuthManager {

    public static function is_authenticated(){
        if(isset($_SESSION['logged_in'])){
            return $_SESSION['logged_in'];
        }
        return false;
    }
    
    public static function redirect_unauthenticated_user_to_login($session){
        if(!isset($session['logged_in']) || !$session['logged_in']){
            header("Location: /index.php");
        }
    }

    public static function logout(){
        session_unset(); 
        session_destroy();
        setcookie( "user", "", time()- 60, "/","", 0);
        header('Location: /');
    }
}
