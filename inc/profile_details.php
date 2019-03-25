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
