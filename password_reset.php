<?php

use VanillaPHP\Repositories\UserRepository;
use VanillaPHP\Helpers\Validator;
use VanillaPHP\Services\PasswordResetService;

session_start();
require __DIR__ . '/inc/bootstrap.php';

$user_email = '';

$user_repo = new UserRepository($db);
if(isset($_POST['reset_password'])){
    $user_email = trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL));

    if(empty($user_email)){
        $error_message = 'Please fill in your email';
    } elseif(!Validator::check_email($user_email)){
        $error_message = 'Invalid email';
    } else{
        $user = $user_repo->find_by_email($user_email);
        if(empty($user)){
            $error_message = 'User with given email does not exist';
        } else {
            $token = bin2hex(random_bytes(50));
            $pass_reset_service = new PasswordResetService($db);
            if($pass_reset_service->save_password_reset_token($user_email, $token)){
                $pass_reset_service->mail_password_reset_instructions($user_email, $token);
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
