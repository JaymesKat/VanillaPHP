<form class="password-reset-form" method="post" action="../password_reset.php">   
    <?php 
        if(isset($error_message)){
            echo "<p class='msg msg-error'>".$error_message."</p>";
        }
    ?>
    <div class="row margin">
        <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input name="user_email" id="user_email" type="email" class="validate" value="<?php echo htmlspecialchars($user_email); ?>">
            <label for="user_email" class="center-align">Enter email here to receive password reset instructions</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <button type="submit" name="reset_password" class="btn waves-effect waves-light col s12 light-blue lighten-1">Submit</button>
        </div>
    </div>
</form>
