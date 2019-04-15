<?php
use VanillaPHP\Repositories\UserRepository;
use VanillaPHP\Helpers\Validator;

session_start();
require __DIR__ . '/inc/bootstrap.php';

$user_email = $user_pass = '';
$user_repo = new UserRepository($db);

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header('Location: users');
} elseif(isset($_COOKIE['user'])){
    $user_repo->find_by_email($_COOKIE['user']);
    $_SESSION['logged_in'] = true;
    $_SESSION['logged_in_user_id'] = (int) $user['id'];
    $_SESSION['logged_in_user_role'] = (int) $user['role'];
    header("Location: users");
} else {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_email = trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL));
        $user_pass = $_POST['user_pass'];

        if(empty($user_email) || empty($user_pass)){
            $error_message = 'Please fill all required fields: Email and Password';
        } elseif(!Validator::check_email($user_email)){
            $error_message = 'Invalid email';
        } else{
            $user = $user_repo->find_by_email($user_email);
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
                    setcookie("user", $user['email'], strtotime("+1day"), "/");
                    header("Location: users");
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
                <?php include "inc/login_form.php"; ?>
            </div>
        </div>
    </div>
</div>
<?php
  include "inc/footer.php";
?>
