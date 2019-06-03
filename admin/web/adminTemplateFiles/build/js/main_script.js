$(document).ready(function () {
    $('.sidebar_wrapper').find('.content').find('a').each(function(index){
        if ( $(this).text() == localStorage.getItem('self_data') ){
            $(this).addClass('active')
            if ( $(this).parent().parent().parent().find('ul').length > 0  ){
                $(this).parent().parent().parent().find(' > a').addClass('active') 
            }
        }
    })
    $('.sidebar_wrapper').find('.content').find('a').click(function(event) {
        if( $(this).parent().find('ul').length > 0 ){
            localStorage.setItem('parent_href',1)
            localStorage.setItem('parent_data',$(this).text())
        }else{
            localStorage.setItem('self_href',1)
            localStorage.setItem('self_data',$(this).text())
        }
    });  
    $('.menu_humbegrer_toggle').click(function(event) {
    	$(this).toggleClass('active');
    	$('.sidebar_wrapper').toggleClass('active');
        $('.all_warrapers_web_content').toggleClass('margin_left_activated');
    });

    $("#menu").find('a').click(function(event){
    	removeActiveClassForSideBarmenu()
    	if ( $(this).hasClass('active') ){
    		$(this).removeClass('active')
    		if ( $(this).next('ul').length ){
    			$(this).next().slideUp();
    			$(this).children('i:last-child').toggleClass('fa-caret-down fa-caret-up');
    		}
    	}else{
    		$(this).addClass('active')
    		if ( $(this).next('ul').length ){
                $("#menu").find('ul').find('li').find('a').removeClass('active');
                $("#menu").find('ul').find('li').find('.menu-parent').children('i:last-child').removeClass('fa-caret-up');
                $("#menu").find('ul').find('li').find('.menu-parent').children('i:last-child').addClass('fa-caret-down');
                $("#menu").find('ul').find('li').find('.sousmenu').hide(); 
    			$(this).next().slideDown();
    			$(this).children('i:last-child').toggleClass('fa-caret-down fa-caret-up');
    		}
    	}
	});

    $(".user_name").click(function(event) {
        var link = $(this).find('logout_icon').data('href');
        window.location.href = link;
    });

    $('.header_for_element_state').find('.option').click(function(event) {
        var this_index = $(this).index()
        $(this).parent().find('.option').each(function(index, el) {
            $(this).attr('data-index', 1)
            $(this).removeClass('active')
        });
        $('.select_ctrl_state').val($(this).data('value'))
        $(this).attr('data-index', 2)
        $(this).addClass('active')
        $(this).parent().toggleClass('opened');
    });

    $('.tablesTabs').find('button').click(function(){
        $(this).parent().find('button').each(function(){
            $(this).removeClass('active')
        })
        $(this).addClass('active')
    })
    $('body').find('.hiddentextarea').each(function(){
        $(this).attr('required',false)
        $(this).parent().parent().hide();
    })
    $('body').on('change', 'input:file.inputimageUpload',function(event){
        var reader = new FileReader();
        var img = document.createElement("img");
        var imageUrl;
        $(this).parent().find('.DisplayImageAfterUpload').remove();
        $(this).parent().append('<div class="DisplayImageAfterUpload"></div>')
        var output = $(this).parent().find('.DisplayImageAfterUpload');
        output = $(this).parent().find('.DisplayImageAfterUpload').empty();
        reader.onload = function(){
            img.src  = reader.result;
            output.append(img)
            localStorage.setItem('item',imageUrl)
        }
        reader.readAsDataURL(event.target.files[0]);
    })
    $('body').on('mouseenter','.form_ctrl',function(){
        if( $(this).data('label') !== undefined ){
            $(this).parent().find('.toolLabel').remove()
            $(this).parent().append('<div class="toolLabel">'+$(this).data('label')+'</div>');
            $(this).parent().find('.toolLabel').css('opacity',1)
        }

    })
    $('body').on('mouseleave','.form_ctrl',function(){
        if( $(this).data('label') !== undefined ){
            $(this).parent().find('.toolLabel').remove()
        }
    })

    $('.btn-reset').click(function(event) {
        window.open($(this).data('href'), "amz");
        return false;
    });


    $('.btn-show-liste').click(function(event) {
         $(this).find('.fa').toggleClass('fa-caret-down fa-caret-up');
         $(this).parent().find('.btn-hidden').slideToggle() ;
    });

    $('.status').click(function(event) {
       var stat = $('.status').attr('data-value');

       if (stat == 1){
        $('.status').attr('data-value', 0);
        $( ".status span" ).text('on-line');
       }else{
        $('.status').attr('data-value', 1);
        $( ".status span" ).text('off-line');
       }
        $(this).toggleClass('on-line off-line');
        $('.select_ctrl_state').val(stat);
    });
    $('.dd-button').click(function(event) {
         $('.dd-box').slideToggle() ;
    });
    $('.contentElement').click(function(event) {
         $(this).parent('.dd-box').slideToggle() ;
    });
    if ($('.seo_title').length > 0){
        $('.title_page').on('input',function(e){
            var x = $('.title_page').val();
            $('.seo_title').val(x);
            $('.seo_description').val(x);
        });
    }

    $('.select-cat-foulard').change(function(event) {
       var stat = $('.select-cat-foulard').val();
       if (stat == 1){
        $('.foulard-cat').slideDown();
        // $('.simple-cat').slideUp();
       }else{
        // $('.simple-cat').slideDown();
        $('.foulard-cat').slideUp();
       }
    });
    if ($('.select-cat-foulard').length > 0){
    var stat = $('.select-cat-foulard').val();
       if (stat == 1){
        $('.foulard-cat').slideDown();
        // $('.simple-cat').slideUp();
       }else{
        // $('.simple-cat').slideDown();
        $('.foulard-cat').slideUp();
       }
   }
   $('.select-ref').change(function(event) {
       var stat = $('.select-ref').val();
       if (stat == 1){
        $('.form-link-ref').slideDown();
       }else{
        $('.form-link-ref').slideUp();
       }
    });
    if ($('.select-ref').length > 0){
    var stat = $('.select-cat-foulard').val();
       if (stat == 1){
        $('.form-link-ref').slideDown();
       }else{
        $('.form-link-ref').slideUp();
       }
   }

   $('.visiblityProjectInHome').change(function(event) {
       var stat = $('.visiblityProjectInHome').val();
       if (stat == 1){
        $('.type-img-in-home').slideDown();
        // $('.simple-cat').slideUp();
       }else{
        // $('.simple-cat').slideDown();
        $('.type-img-in-home').slideUp();
       }
    });
    if ($('.visiblityProjectInHome').length > 0){
    var stat = $('.visiblityProjectInHome').val();
       if (stat == 1){
        $('.type-img-in-home').slideDown();
        // $('.simple-cat').slideUp();
       }else{
        // $('.simple-cat').slideDown();
        $('.type-img-in-home').slideUp();
       }
   }


    if (window.location.href.indexOf("content") > -1) {
        $('.content-part').addClass('active');
    }
    if(window.location.href.indexOf("general") > -1)  {
        $('.part').removeClass('active');
        $('.generale-part').addClass('active');
    }
    if(window.location.href.indexOf("seo") > -1)  {
        $('.part').removeClass('active');
        $('.seo-part').addClass('active');
    }
    
    $(".btn-submit , .btn-submitsaveAndStay").click(function() {
        if ($('.required_class').val() == ""){
            alert('Merci de remplir tous les champs obligatoires');
        }
    });
    $('#menu-action').click(function() {
        $('.sidebar').toggleClass('active');
        $('.sidebar_wrapper').toggleClass('active');
        $('.margin_left_activated' ).toggleClass('main-active');
        $(this).toggleClass('active');

        if ($('.sidebar').hasClass('active')) {
        $(this).find('i').addClass('fas fa-caret-left');
        $(this).find('i').removeClass('fa-bars');
        } else {
        $(this).find('i').addClass('fa-bars');
        $(this).find('i').removeClass('fas fa-caret-left');
        }
    });

});
