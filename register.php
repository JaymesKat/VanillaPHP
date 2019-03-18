<?php
  session_start();
  include "inc/functions.php";

  $first_name = $last_name = $user_email = $user_pass = $confirm_pass = '';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
    $user_email = trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL));
    $user_pass = trim(filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_STRING));
    $confirm_pass = trim(filter_input(INPUT_POST, 'confirm_pass', FILTER_SANITIZE_STRING));

    if(empty($first_name) || empty($last_name) || empty($user_email) ||empty($user_pass) || empty($confirm_pass)){
        $error_message = 'Please fill all required fields: First name, Last name, Email, Password, Password Confirmation';
    } elseif(!check_name($first_name) || !check_name($last_name)){
        $error_message = 'First name and Last name should have only letters or white spaces';
    } elseif(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        $error_message = 'Invalid email';
    }
    elseif($user_pass !== $confirm_pass){
        $error_message = 'Passwords do not match';
    } elseif(!empty(find_user_by_email($user_email))){
        $error_message = 'User already exists';
    }
    else {
        $user_pass = password_hash($user_pass, PASSWORD_DEFAULT);
        if(add_user($first_name, $last_name, $user_email, $user_pass)){
            header('Location: index.php');
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
                <form class="register-form" method="post" action="register.php">   
                    <?php 
                        if(isset($error_message)){
                            echo "<p class='msg msg-error'>".$error_message."</p>";
                        }
                    ?>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input name="first_name" id="first_name" type="text" class="validate" value="<?php echo htmlspecialchars($first_name); ?>">
                            <label for="first_name" class="center-align">First name</label>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input name="last_name" id="last_name" type="text" class="validate" value="<?php echo htmlspecialchars($last_name); ?>">
                            <label for="last_name" class="center-align">Last name</label>
                        </div>
                    </div>
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
                            <input name="user_pass" id="user_pass" type="password" class="validate" value="<?php echo htmlspecialchars($user_pass); ?>">
                            <label for="user_pass">Password</label>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input name="confirm_pass" id="confirm_pass" type="password" value="<?php echo htmlspecialchars($confirm_pass); ?>">
                            <label for="confirm_pass">Re-type password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10 offset-s1">
                            <button type="submit" class="btn waves-effect waves-light col s12 light-blue lighten-1">Register</button>
                        </div>
                        <div class="input-field col s12">
                            <p class="margin center medium-small sign-up">Already have an account? <a href="/">Login</a></p>
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
