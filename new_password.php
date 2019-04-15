<?php

use VanillaPHP\Repositories\UserRepository;
use VanillaPHP\Services\PasswordResetService;

session_start();

require __DIR__ . '/inc/bootstrap.php';

if (isset($_GET['token'])) {
    $_SESSION['token'] = trim(filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING));
}
$user_pass = $confirm_pass = '';

if(isset($_POST['new_password'])){
    $user_pass = trim(filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_STRING));
    $confirm_pass = trim(filter_input(INPUT_POST, 'confirm_pass', FILTER_SANITIZE_STRING));

    if(empty($user_pass) || empty($confirm_pass)){
        $error_message = 'Please fill in new password and confirmation';
    } elseif($user_pass !== $confirm_pass){
        $error_message = 'Passwords do not match';
    } else{
        $token = $_SESSION['token'];
        $user_pass = password_hash($user_pass, PASSWORD_DEFAULT);

        $pass_reset_service = new PasswordResetService($db);
        $email = $pass_reset_service->get_email_from_token($token);

        $user_repo = new UserRepository($db);
        $response = $user_repo->update_password($email, $user_pass);
        if($response){
            $message = 'Password updated Successfully';
        } else {
            $message = 'Password update failed';
        }
    }
}

include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <h4>Enter New Password</h4>
        <div id="new-password-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <form class="password-reset-form" method="post" action="new_password">
                    <?php
                        if(isset($error_message)){
                            echo "<p class='msg msg-error'>".$error_message."</p>";
                        }
                    ?>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input name="user_pass" id="user_pass" type="password" class="validate" value="<?php echo htmlspecialchars($user_pass); ?>" required/>
                            <label for="user_pass">Password</label>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input name="confirm_pass" id="confirm_pass" type="password" value="<?php echo htmlspecialchars($confirm_pass); ?>" required>
                            <label for="confirm_pass">Re-type password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" name="new_password" class="btn waves-effect waves-light col s12 light-blue lighten-1">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
  include "inc/footer.php";
?>
