<?php

use VanillaPHP\Repositories\UserRepository;
use VanillaPHP\Helpers\AuthManager;

session_start(); 
require __DIR__ . '/inc/bootstrap.php';


AuthManager::redirect_unauthenticated_user_to_login($_SESSION);
$user_id = $_SESSION['logged_in_user_id'];
$user_repo = new UserRepository($db);
$user = $user_repo->find_by_id($user_id);

$first_name = $user['first_name'];
$last_name = $user['last_name'];
$user_email = $user['email'];

if(isset($_POST['edit_profile'])){
    $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));

    if(empty($first_name) || empty($last_name)){
        $error_message = 'Please fill in required fields: First Name, Last Name';
    } else{
        $result = $user_repo->update_profile($user_id, $first_name, $last_name);
        if($result){
            $_SESSION['profile_updated'] = true;
            header("Location: profile");
        } else {
            $error_message = "Update failed. Try again later";
        }
    }
}

include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container"> 
    <div id="edit-profile-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <?php include "inc/edit_profile_form.php"; ?>
            </div>
        </div>
    </div>
</div>
<?php 
include "inc/footer.php";
?>
