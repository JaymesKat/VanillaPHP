<?php

use VanillaPHP\Repositories\UserRepository;
use VanillaPHP\Helpers\AuthManager;

session_start();
require __DIR__ . '/inc/bootstrap.php';

AuthManager::redirect_unauthenticated_user_to_login($_SESSION);
$user_repo = new UserRepository($db);
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  if(isset($_GET['is_active']) && isset($_GET['id'])){
    $user_id = $_GET['id'];
    $is_active = $_GET['is_active'];
    $user_repo->update_status($user_id, $is_active);
    header("Location: users?success");
  }
  if(isset($_GET['success'])){
    $message = 'User status updated';
  }

  if(isset($_SESSION['logged_in']) 
    && isset($_SESSION['display_login_success'])
    && ($_SESSION['display_login_success'] == true)){
      $message = 'Successfully logged in';
      $_SESSION['display_login_success'] = false; 
  }
}
include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
<div class="container"> 
        <?php 
          if(isset($message)){
            echo "<p class='msg msg-success'>".$message."</p>";
          }
        ?>
        <h4>Users</h4>	
        <div id="users-page" class="row">
            <div class="col s12">
                <ul id="user-list" class="collection">
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
  include "inc/footer.php";
?>
