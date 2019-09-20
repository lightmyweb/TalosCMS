$(function(){
  $('#forgot').click(function(){
    $('button').toggleClass('forgetPswd');
    var hidden = $("#cont").is(":hidden");
      $('#cont').slideToggle(500,function(){
        if(!hidden){
          $('#btnclick').html('Recover');
          $('#forgot').html('Back to Login page');
          return false;         
        }else {
          $('#btnclick').html('Login');
          $('#forgot').html('Forgot password?');
          return false;
        }
      });
    });
});