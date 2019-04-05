document.addEventListener('DOMContentLoaded',function(){
    req=new XMLHttpRequest();
    req.open("GET", '/api/users', true);
    req.send();
    req.onload=function(){
        users=JSON.parse(req.responseText);
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
        document.getElementById('user-list').innerHTML = usersHTML;
    };
});
