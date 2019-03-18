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

function display_user_html($user){
    return "<li class='collection-item avatar'>
            <span class='title'>".
            $user['first_name']." ".$user['last_name']."
            </span>
            <p>".$user['email'].
            "</p>
            <a href='#!' class='secondary-content'><i class='material-icons'>grade</i>Disable</a>
            </li>";
}

function check_name($name){
    return preg_match("/^[a-zA-Z ]*$/",$name);
}
?>
