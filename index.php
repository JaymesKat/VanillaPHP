<?php
session_start();

include "inc/functions.php";
$user_email = $user_pass = '';

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header('Location: users.php');
} else {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_email = trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL));
        $user_pass = $_POST['user_pass'];

        if(empty($user_email) || empty($user_pass)){
            $error_message = 'Please fill all required fields: Email and Password';
        } elseif(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
            $error_message = 'Invalid email';
        } else{
            $user = find_user_by_email($user_email);
            if(empty($user)){
            $error_message = 'User with given email was not found';
            } else {
                if(!password_verify($user_pass, $user['pass'])){
                    $error_message = "Incorrect Password";
                } else {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['logged_in_user_id'] = (int) $user['id'];
                    $_SESSION['logged_in_user_role'] = (int) $user['role'];
                    $_SESSION['display_login_success'] = true;
                    header("Location: users.php");
                }
            }
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_GET['logout'])){
            $_SESSION['logout_msg'] = 'Successfully Logged out';
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
                        if(isset($_SESSION['logout_msg'])){
                            echo "<p class='msg msg-success'>".$_SESSION['logout_msg']."</p>";
                            unset($_SESSION['logout_msg']);
                        }
                    ?> 
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-communication-email prefix"></i>
                            <input name="user_email" id="user_email" type="email" class="validate" value="<?php echo htmlspecialchars($user_email); ?>" required/>
                            <label for="user_email" class="center-align">Email</label>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input name="user_pass" id="user_pass" type="password" class="validate" required/>
                            <label for="user_pass">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10 offset-s1">
                            <button type="submit" class="btn waves-effect waves-light col s12 light-blue lighten-1">Login</button>
                        </div>
                        <div class="input-field col s12">
                            <p class="margin center medium-small sign-up">First time here? <a href="register.php">Register</a></p>
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
