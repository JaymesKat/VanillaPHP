<?php
  include "inc/header.php";
  include "inc/functions.php";

  $users = get_all_users();
?>
<div class="section no-pad-bot" id="index-banner">
<div class="container">
        <h4>Users</h4>	 
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
