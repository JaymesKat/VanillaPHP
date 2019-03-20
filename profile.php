<?php
session_start();
include "inc/functions.php";
redirect_unauthenticated_user_to_login($_SESSION);
$user_id = $_SESSION['logged_in_user_id'];
$user = get_user_by_id($user_id);

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
                <li class="collection-header"><h4>Profile</h4></li>
                <li class="collection-item">
                    <div class="row">
                    <div class="col s5 grey-text darken-1">First Name: </div>
                    <div class="col s7 grey-text text-darken-4"><?php echo ucfirst($user['first_name']); ?></div>
                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                    <div class="col s5 grey-text darken-1">Last Name: </div>
                    <div class="col s7 grey-text text-darken-4"><?php echo ucfirst($user['last_name']); ?></div>
                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                    <div class="col s5 grey-text darken-1">Email: </div>
                    <div class="col s7 grey-text text-darken-4"><?php echo $user['email']; ?></div>
                    </div>
                </li>
                <li class="collection-item right-align">
                    <a href="/edit_profile.php"class="waves-effect waves-light light-blue lighten-1 btn">
                        <i class="material-icons right">edit</i>
                        EDIT
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php 
include "inc/footer.php";
?>
