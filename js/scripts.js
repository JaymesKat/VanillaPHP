$(document).ready(function() {
    var states_url = 'http://services.groupkt.com/state/get/IND/all'
      
    $.ajax({
        url: states_url,
        dataType: 'jsonp',
        success: function(result){
            console.log(result);
        }
    });
});
