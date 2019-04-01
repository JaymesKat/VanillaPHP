<?php

use VanillaPHP\Repositories\UserRepository;
use VanillaPHP\Helpers\Validator;

session_start();
require __DIR__ . '/inc/bootstrap.php';

$first_name = $last_name = $user_email = $user_pass = $confirm_pass = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
    $user_email = trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL));
    $user_pass = $_POST['user_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    $user_repo = new UserRepository($db);

    if(empty($first_name) || empty($last_name) || empty($user_email) ||empty($user_pass) || empty($confirm_pass)){
        $error_message = 'Please fill all required fields: First name, Last name, Email, Password, Password Confirmation';
    } elseif(!Validator::check_name($first_name) || !Validator::check_name($last_name)){
        $error_message = 'First name and Last name should have only letters or white spaces';
    } elseif(!Validator::check_email($user_email)){
        $error_message = 'Invalid email';
    } elseif($user_pass !== $confirm_pass){
        $error_message = 'Passwords do not match';
    } elseif(!empty($user_repo->find_by_email($user_email))){
        $error_message = 'User already exists';
    }
    else {
        $user_pass = password_hash($user_pass, PASSWORD_DEFAULT);
        if($user_repo->add($first_name, $last_name, $user_email, $user_pass)){
            header('Location: /');
            exit;
        } else {
            $error_message = "Could not add user";
        }
    }
  }
  include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <h4>Register Your New Account</h4>	 
        <div id="register-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <?php include "inc/register_form.php"; ?>
            </div>
        </div>
    </div>
</div>
<?php
  include "inc/footer.php";
?>
