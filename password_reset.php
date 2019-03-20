<?php
session_start();

include "inc/functions.php";
$user_email = '';

if(isset($_POST['reset_password'])){
    $user_email = trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL));

    if(empty($user_email)){
        $error_message = 'Please fill in your email';
    } elseif(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        $error_message = 'Invalid email';
    } else{
        $user = find_user_by_email($user_email);
        if(empty($user)){
            $error_message = 'User with given email does not exist';
        } else {
            $token = bin2hex(random_bytes(50));
            if(save_password_reset_token($user_email, $token)){
                mail_password_reset_instructions($user_email, $token);
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
                <form class="password-reset-form" method="post" action="password_reset.php">   
                    <?php 
                        if(isset($error_message)){
                            echo "<p class='msg msg-error'>".$error_message."</p>";
                        }
                    ?>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-communication-email prefix"></i>
<<<<<<< Updated upstream
                            <input name="user_email" id="user_email" type="email" class="validate" value="<?php echo htmlspecialchars($user_email); ?>">
                            <label for="user_email" class="center-align">Enter email here to receive password reset instructions</label>
=======
                            <input name="user_email" id="user_email" type="email" class="validate" required>
                            <label for="user_email" class="center-align">Enter email here to receive password reset link</label>
>>>>>>> Stashed changes
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" name="reset_password" class="btn waves-effect waves-light col s12 light-blue lighten-1">Submit</button>
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
