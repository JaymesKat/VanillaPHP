$(document).ready(function(){
    function displayUsers(users){
        usersHTML = '';
        for(let i=0; i<users.length; i+=1){
            usersHTML += "<li class='collection-item avatar'><span class='title'>";
            usersHTML += users[i].first_name +" "+users[i].last_name+"</span><p>"+users[i].email+"</p>";
            if(users[i].is_active == "yes"){
                usersHTML += "<a href='users?id="+users[i].id+"&is_active=no' class='secondary-content'>Deactivate</a>";
            } else {
                usersHTML += "<a href='users?id="+users[i].id+"&is_active=yes' class='secondary-content'>Activate</a>";
            }
            usersHTML+="</li>";
        }
        $('#user-list').html(usersHTML);
    }
    $.getJSON('/api/users', displayUsers);    
});
