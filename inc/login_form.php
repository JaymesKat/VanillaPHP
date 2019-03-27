<form class="login-form" method="post" action="../index.php">  
    <?php 
        if(isset($error_message)){
            echo "<p class='msg msg-error'>".$error_message."</p>";
        }
        if(isset($_SESSION['logout_msg'])){
            echo "<p class='msg msg-success'>".$_SESSION['logout_msg']."</p>";
            unset($_SESSION['logout_msg']);
        }
    ?> 
    <div class="row margin">
        <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input name="user_email" id="user_email" type="email" class="validate" value="<?php echo htmlspecialchars($user_email); ?>" required/>
            <label for="user_email" class="center-align">Email</label>
        </div>
    </div>
    <div class="row margin">
        <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input name="user_pass" id="user_pass" type="password" class="validate" required/>
            <label for="user_pass">Password</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s10 offset-s1">
            <button type="submit" class="btn waves-effect waves-light col s12 light-blue lighten-1">Login</button>
        </div>
        <div class="input-field col s12">
            <p class="margin center medium-small sign-up">First time here? <a href="register">Register</a></p>
            <p class="margin center medium-small sign-up">Forgot your password? <a href="password_reset">Reset</a></p>
        </div>
    </div>
</form>
