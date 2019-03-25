<form class="register-form" method="post" action="../register.php">   
    <?php 
        if(isset($error_message)){
            echo "<p class='msg msg-error'>".$error_message."</p>";
        }
    ?>
    <div class="row margin">
        <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input name="first_name" id="first_name" type="text" class="validate" value="<?php echo htmlspecialchars($first_name); ?>" required/>
            <label for="first_name" class="center-align">First name</label>
        </div>
    </div>
    <div class="row margin">
        <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input name="last_name" id="last_name" type="text" class="validate" value="<?php echo htmlspecialchars($last_name); ?>" required/>
            <label for="last_name" class="center-align">Last name</label>
        </div>
    </div>
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
            <input name="user_pass" id="user_pass" type="password" class="validate" value="<?php echo htmlspecialchars($user_pass); ?>" required/>
            <label for="user_pass">Password</label>
        </div>
    </div>
    <div class="row margin">
        <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input name="confirm_pass" id="confirm_pass" type="password" value="<?php echo htmlspecialchars($confirm_pass); ?>" required/>
            <label for="confirm_pass">Re-type password</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s10 offset-s1">
            <button type="submit" class="btn waves-effect waves-light col s12 light-blue lighten-1">Register</button>
        </div>
        <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="/">Login</a></p>
        </div>
    </div>
</form>
