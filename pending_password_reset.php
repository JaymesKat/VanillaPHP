<?php
require __DIR__ . '/inc/bootstrap.php';

if(isset($_GET['email'])){
    $email = $_GET['email'];
} else {
    header('location: /');
}
include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <h4>Awaiting Password Reset</h4>	 
        <div id="pending-password-reset-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <form class="password-reset-form" method="post" action="new_password.php">   
                    <?php 
                        if(isset($email)){
                            echo "<p class='msg msg-success'> Password Reset instructions sent to $email</p>";
                        }
                    ?>
                    <div class="row margin">
                        <div class="col s12">
                            Check your email for password reset link
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
