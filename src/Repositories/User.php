<?php
namespace VanillaPHP\Repositories;

class User {

    public static function get_all_users(){
        global $db;
        try{
            $results = $db->query("SELECT * FROM users");
        } catch(Exception $e){
            echo "Failed to fetch users";
            exit;
        }
    
        $users = $results->fetchAll();
        return $users;
    }
    
    public static function get_user_by_id($id){
        global $db;
        try {
            $sql = "SELECT first_name, last_name, email FROM users WHERE id = ?";
            $results = $db->prepare($sql);
            $results->bindValue(1, $id, \PDO::PARAM_STR);
            $results->execute();
            return $results->fetch();
        } catch(Exception $e){
            echo "Error!: ".$e->getMessage();
        }
    }
    
    public static function find_user_by_email($email){
        global $db;
        try {
            $sql = "SELECT * FROM users WHERE email = ?";
            $results = $db->prepare($sql);
            $results->bindValue(1, $email, \PDO::PARAM_STR);
            $results->execute();
            return $results->fetch();
        } catch(Exception $e){
            echo "Error!: ".$e->getMessage();
        }
    }
    
    public static function add_user($first_name, $last_name, $email, $password){
        global $db;
        $sql = "INSERT INTO users (first_name, last_name, email, pass, role) VALUES(?, ?, ?, ?, 2)";
        try {
            $results = $db->prepare($sql);
            $results->bindValue(1, $first_name, \PDO::PARAM_STR);
            $results->bindValue(2, $last_name, \PDO::PARAM_STR);
            $results->bindValue(3, $email, \PDO::PARAM_STR);
            $results->bindValue(4, $password, \PDO::PARAM_STR);
            $results->execute();
        } catch (Exception $e){
            echo "Error!: ".$e->getMessage();
            return false;
        }
        return true;
    }

    public static function update_user_status($user_id, $new_status){
        global $db;
        $sql = "UPDATE users SET is_active = ? WHERE id = ?";
        try {
            $results = $db->prepare($sql);
            $results->bindValue(1, $new_status, \PDO::PARAM_STR);
            $results->bindValue(2, $user_id, \PDO::PARAM_INT);
            $results->execute();
        } catch (Exception $e){
            echo "Error!: ".$e->getMessage();
            return false;
        }
        return true;
    }
    
    public static function update_user_profile($user_id, $first_name, $last_name){
        global $db;
        $sql = "UPDATE users SET first_name = ?, last_name = ? WHERE id = ?";
        try {
            $results = $db->prepare($sql);
            $results->bindValue(1, $first_name, \PDO::PARAM_STR);
            $results->bindValue(2, $last_name, \PDO::PARAM_STR);
            $results->bindValue(3, $user_id, \PDO::PARAM_INT);
            $results->execute();
        } catch (Exception $e){
            echo "Error!: ".$e->getMessage();
            return false;
        }
        return true;
    }

    public static function update_user_password($email, $password){
        global $db;
        $sql = "UPDATE users SET pass = ? WHERE email = ?";
        try {
            $results = $db->prepare($sql);
            $results->bindValue(1, $password, \PDO::PARAM_STR);
            $results->bindValue(2, $email, \PDO::PARAM_STR);
            $results->execute();
        } catch (Exception $e){
            echo "Error!: ".$e->getMessage();
            return false;
        }
        return true;
    }
}
