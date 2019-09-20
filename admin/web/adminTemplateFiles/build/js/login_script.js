$(document).ready(function () {
    $('.reset_pass').click(function (e) { 
        $('.passwordHide').addClass('active')
    });
    $('.passwordHide').find('i').click(function(){
        $('.passwordHide').removeClass('active');
    })
    $('#mdp_oublie').click(function () {
        if ( $('.email_mdp').val() != '' ){
            var email = $('.email_mdp').val();
            if ( isEmail(email) ){
                var action = $(this).data('rel');
                $.ajax({
                    type: 'POST',
                    url: action,
                    data:{email:email},
                    success:function(data){
                      console.log(data)
                      $(".rep").html('<div class="alert alert-success"><b>Un e-mail a été envoyé à l\'adresse '+email+'. Il contient un lien sur lequel il vous faudra cliquer afin de réinitialiser votre mot de passe.</b></div>');
                      $(".form_mdp_oublie").css("display", "none");
                    },
                    error:function(data){
                        $(".rep").html('<div class="alert alert-danger"><b>Erreur.</b></div>');
                    },
                });
            }
        }  
        
    })
});