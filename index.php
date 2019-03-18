<?php
session_start();
// Disable form re-submission when back button is pressed
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");

include "inc/functions.php";
$user_email = $user_pass = '';
var_dump($_SESSION);

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    echo 'inside if';
    header('Location: users.php');
} else {
    echo 'inside else';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_email = trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL));
        $user_pass = trim(filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_STRING));

        if(empty($user_email) || empty($user_pass)){
            $error_message = 'Please fill all required fields: Email and Password';
        } else{
            $user = find_user_by_email($user_email);
            if(empty($user)){
            $error_message = 'User with given email was not found';
            } else {
                if($user_pass !== $user['pass']){
                    $error_message = "Incorrect Password";
                } else {
                    $_SESSION['logged_in'] = true;
                    header("Location: users.php");
                }
            }
        }
    }
}
include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
<div class="container">
        <h4>Login</h4>	 
        <div id="login-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <form class="login-form" method="post" action="index.php">  
                    <?php 
                        if(isset($error_message)){
                            echo "<p class='msg msg-error'>".$error_message."</p>";
                        }
                    ?> 
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-communication-email prefix"></i>
                            <input name="user_email" id="user_email" type="email" class="validate" value="<?php echo htmlspecialchars($user_email); ?>">
                            <label for="user_email" class="center-align">Email</label>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input name="user_pass" id="user_pass" type="password" class="validate">
                            <label for="user_pass">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10 offset-s1">
                            <button type="submit" class="btn waves-effect waves-light col s12 light-blue lighten-1">Login</button>
                        </div>
                        <div class="input-field col s12">
                            <p class="margin center medium-small sign-up">First time here? <a href="register.php">Sign Up</a></p>
                            <p class="margin center medium-small sign-up">Forgot your password? <a href="password_reset.php">Reset</a></p>
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
