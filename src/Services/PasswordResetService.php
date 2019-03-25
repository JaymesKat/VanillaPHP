<?php
namespace VanillaPHP\Services;

class PasswordResetService {

    public static function save_password_reset_token($email, $token){
        global $db;
        $sql = "INSERT INTO password_resets (email, token) VALUES(?, ?)";
        try {
            $results = $db->prepare($sql);
            $results->bindValue(1, $email, PDO::PARAM_STR);
            $results->bindValue(2, $token, PDO::PARAM_STR);
            $results->execute();
        } catch (Exception $e){
            echo "Error!: ".$e->getMessage();
            return false;
        }
        return true;
    }
    
    public static function mail_password_reset_instructions($email, $token){
        $to = $email;
        $subject = "Reset your password: PetProject website";
        $msg = "Hi there, click on this <a href='new_password.php?token=' . $token . '>link</a> to reset your password on our site";
        $msg = wordwrap($msg,70);
        $headers = "From: admin@petproject.com";
        var_dump(mail($to, $subject, $msg, $headers));
        header('location: /../pending_password_reset.php?email=' . $email);
    }
    
    public static function get_email_from_token($token){
        global $db;
        try {
            $sql = "SELECT email FROM password_resets WHERE token = ?";
            $results = $db->prepare($sql);
            $results->bindValue(1, $token, PDO::PARAM_STR);
            $results->execute();
            $user = $results->fetch();
            return $user['email'];
        } catch(Exception $e){
            echo "Error!: ".$e->getMessage();
        }
        return false;
    }
    
}
