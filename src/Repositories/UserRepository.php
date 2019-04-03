<?php
namespace VanillaPHP\Repositories;

class UserRepository {
    var $db;
    function __construct($db){
        $this->db = $db;
    }

    public function get_all(){
        try{
            $results = $this->db->query("SELECT first_name, last_name, is_active, role  FROM users");
        } catch(Exception $e){
            echo "Failed to fetch users";
            exit;
        }
    
        $users = $results->fetchAll();
        return $users;
    }
    
    public function find_by_id($id){
        try {
            $sql = "SELECT first_name, last_name, email FROM users WHERE id = ?";
            $results = $this->db->prepare($sql);
            $results->bindValue(1, $id, \PDO::PARAM_STR);
            $results->execute();
            return $results->fetch();
        } catch(Exception $e){
            echo "Error!: ".$e->getMessage();
        }
    }
    
    public function find_by_email($email){
        try {
            $sql = "SELECT * FROM users WHERE email = ?";
            $results = $this->db->prepare($sql);
            $results->bindValue(1, $email, \PDO::PARAM_STR);
            $results->execute();
            return $results->fetch();
        } catch(Exception $e){
            echo "Error!: ".$e->getMessage();
        }
    }
    
    public function add($first_name, $last_name, $email, $password){
        $sql = "INSERT INTO users (first_name, last_name, email, pass, role) VALUES(?, ?, ?, ?, 2)";
        try {
            $results = $this->db->prepare($sql);
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

    public function update_status($user_id, $new_status){
        $sql = "UPDATE users SET is_active = ? WHERE id = ?";
        try {
            $results = $this->db->prepare($sql);
            $results->bindValue(1, $new_status, \PDO::PARAM_STR);
            $results->bindValue(2, $user_id, \PDO::PARAM_INT);
            $results->execute();
        } catch (Exception $e){
            echo "Error!: ".$e->getMessage();
            return false;
        }
        return true;
    }
    
    public function update_profile($user_id, $first_name, $last_name){
        $sql = "UPDATE users SET first_name = ?, last_name = ? WHERE id = ?";
        try {
            $results = $this->db->prepare($sql);
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

    public function update_password($email, $password){
        $sql = "UPDATE users SET pass = ? WHERE email = ?";
        try {
            $results = $this->db->prepare($sql);
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
