<?php
use VanillaPHP\Repositories\User;
use VanillaPHP\Helpers\AuthManager;

session_start();
require __DIR__ . '/inc/bootstrap.php';

AuthManager::redirect_unauthenticated_user_to_login($_SESSION);

$user_id = $_SESSION['logged_in_user_id'];
$user = User::find_by_id($user_id);

if(isset($_SESSION['profile_updated']) && $_SESSION['profile_updated']) {
    $profile_updated = true;
    unset($_SESSION['profile_updated']);
}

include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container"> 
        <div id="profile-page" class="row">
            <ul class="col s8 collection with-header z-depth-1">
                <?php 
                    if(isset($profile_updated)){
                        echo "<p class='msg msg-success'>Profile Successfully Updated</p>";
                    }
                ?>
                <?php include "inc/profile_details.php"; ?>
            </ul>
        </div>
    </div>
</div>
<?php 
include "inc/footer.php";
?>
