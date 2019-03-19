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

function find_user_by_email($email){
    include 'connection.php';

    try {
        $sql = "SELECT * FROM users WHERE email = ?";
        $results = $db->prepare($sql);
        $results->bindValue(1, $email, PDO::PARAM_STR);
        $results->execute();
        return $results->fetch();
    } catch(Exception $e){
        echo "Error!: ".$e->getMessage();
    }
}

function add_user($first_name, $last_name, $email, $password){
    include 'connection.php';

    $sql = "INSERT INTO users (first_name, last_name, email, pass, role) VALUES(?, ?, ?, ?, 2)";
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
            "</p>"
            .($user['is_active'] == 'yes'?
             "<a href='users.php?id=".$user['id']."&is_active=no' class='secondary-content'>Deactivate</a>":
             "<a href='users.php?id=".$user['id']."&is_active=yes' class='secondary-content'>Activate</a>").
            "</li>";
}

function check_name($name){
    return preg_match("/^[a-zA-Z ]*$/",$name);
}

function update_user_status($user_id, $new_status){
    include 'connection.php';

    $sql = "UPDATE users SET is_active = ? WHERE id = ?";
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $new_status, PDO::PARAM_STR);
        $results->bindValue(2, $user_id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e){
        echo "Error!: ".$e->getMessage();
        return false;
    }
    return true;
}

function is_authenticated(){
    if(isset($_SESSION['logged_in'])){
        return $_SESSION['logged_in'];
    }
    return false;
}

function save_password_reset_token($email, $token){
    include 'connection.php';

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

function mail_password_reset_instructions($email, $token){
    $to = $email;
    $subject = "Reset your password: PetProject website";
    $msg = "Hi there, click on this <a href='new_password.php?token=' . $token . '>link</a> to reset your password on our site";
    $msg = wordwrap($msg,70);
    $headers = "From: admin@petproject.com";
    var_dump(mail($to, $subject, $msg, $headers));
    header('location: /../pending_password_reset.php?email=' . $email);
}

function get_email_from_token($token){
    include 'connection.php';

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

function update_user_password($email, $password){
    include 'connection.php';

    $sql = "UPDATE users SET pass = ? WHERE email = ?";
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $password, PDO::PARAM_STR);
        $results->bindValue(2, $email, PDO::PARAM_STR);
        $results->execute();
    } catch (Exception $e){
        echo "Error!: ".$e->getMessage();
        return false;
    }
    return true;
}

?>
