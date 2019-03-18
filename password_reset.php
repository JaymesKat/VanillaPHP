<?php
  include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <h4>Reset Password</h4>	 
        <div id="reset-password-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <form class="password-reset-form" method="post" action="">   
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-communication-email prefix"></i>
                            <input name="user_email" id="user_email" type="email" class="validate">
                            <label for="user_email" class="center-align">Enter email here to receive password reset link</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect waves-light col s12 light-blue lighten-1">Submit</button>
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
