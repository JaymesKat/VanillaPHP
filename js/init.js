(function($){
  $(function(){

    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

setTimeout(function(){
  if ($('.msg.msg-success').length > 0) {
    $('.msg.msg-success').remove();
  }
}, 5000)
