<?php
session_start();
include "inc/functions.php";
redirect_unauthenticated_user_to_login($_SESSION);
$user_id = $_SESSION['logged_in_user_id'];
$user = get_user_by_id($user_id);

$first_name = $user['first_name'];
$last_name = $user['last_name'];
$user_email = $user['email'];

if(isset($_POST['edit_profile'])){
    $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));

    if(empty($first_name) || empty($last_name)){
        $error_message = 'Please fill in required fields: First Name, Last Name';
    } else{
        $result = update_user_profile($user_id, $first_name, $last_name);
        if($result){
            $_SESSION['profile_updated'] = true;
            header("Location: profile.php");
        } else {
            $error_message = "Update failed. Try again later";
        }
    }
}

include "inc/header.php";
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container"> 
    <div id="register-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <form class="register-form" method="post" action="edit_profile.php">   
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
                            <input name="user_email" id="user_email" type="email" class="validate" value="<?php echo htmlspecialchars($user_email); ?>" disabled/>
                            <label for="user_email" class="center-align">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10 offset-s1">
                            <button type="submit" name="edit_profile" class="btn waves-effect waves-light col s12 light-blue lighten-1">Update</button>
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
