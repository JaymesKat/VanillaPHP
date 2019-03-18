<?php
  include "inc/functions.php";

  $message = "";
  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['is_active']) && isset($_GET['id'])){
      $user_id = $_GET['id'];
      $is_active = $_GET['is_active'];
      update_user_status($user_id, $is_active);
      header("Location: users.php?success");
    }

    if(isset($_GET['success'])){
      $message = 'User status updated';
    }
  }

  $users = get_all_users();
  include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
<div class="container">
        <h4>Users</h4>	 
        <?php 
          if($message){
            echo "<p class='msg msg-success'>".$message."</p>";
          }
        ?>
        <div id="login-page" class="row">
            <div class="col s12">
                <ul class="collection">
                    <?php
                    if($users){
                        foreach($users as $user){     
                          echo display_user_html($user);  
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
  include "inc/footer.php";
?>
