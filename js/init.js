(function($){
  $(function(){

    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

setTimeout(function(){
  if ($('.msg').length > 0) {
    $('.msg').remove();
  }
}, 4000)
