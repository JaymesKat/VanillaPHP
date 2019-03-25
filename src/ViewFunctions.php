<?php 

namespace VanillaPHP;

class ViewFunctions {

    public static function display_user_html($user){
        return "<li class='collection-item avatar'>
                <span class='title'>".
                $user['first_name']." ".$user['last_name']."
                </span>
                <p>".$user['email'].
                "</p>"
                .($user['is_active'] == 'yes'?
                 "<a href='users.php?id=".$user['id']."&is_active=no' class='secondary-content'>Deactivate</a>":
                 "<a href='users.php?id=".$user['id']."&is_active=yes' class='secondary-content'>Activate</a>").
                "</li>";
    }
}
