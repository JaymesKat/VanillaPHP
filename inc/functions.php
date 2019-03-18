<?php

function get_all_users(){
    include "connection.php";
    try{
        $results = $db->query("SELECT * FROM users");
    } catch(Exception $e){
        echo "Failed to fetch users";
        exit;
    }

    $users = $results->fetchAll();
    return $users;
}

function add_user($first_name, $last_name, $email, $password){
    include 'connection.php';

    $sql = "INSERT INTO users (first_name, last_name, email, pass) VALUES(?, ?, ?, ?)";
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $first_name, PDO::PARAM_STR);
        $results->bindValue(2, $last_name, PDO::PARAM_STR);
        $results->bindValue(3, $email, PDO::PARAM_STR);
        $results->bindValue(4, $password, PDO::PARAM_STR);
        $results->execute();
    } catch (Exception $e){
        echo "Error!: ".$e->getMessage();
        return false;
    }
    return true;
}

function display_user_html($user){
    return "<li class='collection-item avatar'>
            <span class='title'>".
            $user['first_name']." ".$user['last_name']."
            </span>
            <p>".$user['email'].
            "</p>
            <a href='#!' class='secondary-content'>Deactivate</a>
            </li>";
}

function check_name($name){
    return preg_match("/^[a-zA-Z ]*$/",$name);
}

?>
