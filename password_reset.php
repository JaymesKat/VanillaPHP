<?php

use VanillaPHP\Repositories\User;
use VanillaPHP\Helpers\Validator;
use VanillaPHP\Services\PasswordResetService;

session_start();
require __DIR__ . '/inc/bootstrap.php';

$user_email = '';

if(isset($_POST['reset_password'])){
    $user_email = trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL));

    if(empty($user_email)){
        $error_message = 'Please fill in your email';
    } elseif(!Validator::check_email($user_email)){
        $error_message = 'Invalid email';
    } else{
        $user = User::find_by_email($user_email);
        if(empty($user)){
            $error_message = 'User with given email does not exist';
        } else {
            $token = bin2hex(random_bytes(50));
            if(PasswordResetService::save_password_reset_token($user_email, $token)){
                PasswordResetService::mail_password_reset_instructions($user_email, $token);
            }
        }
    }
}
include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <h4>Reset Password</h4>	 
        <div id="reset-password-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <?php include "inc/reset_password_form.php"; ?>
            </div>
        </div>
    </div>
</div>
<?php
  include "inc/footer.php";
?>
