function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

function isValidPhoneNumber(phoneNumber) {
    var pattern = /([0-9]{8})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/; 
    return pattern.test(phoneNumber);
}
function calculatesubLiForheigth(element){
	if( element.find('ul').find('li').length > 0 ){
		//return ( ( ( element.find('ul').find('li').length + 1 )  * 42 ) + element.find('ul').find('li').length )
		return ( ( element.find('ul').find('li').length + 1 )  * 42 )
	}else{
		return 42 
	}
}
function activateFirstChild(element){
	element.find('li').each(function(index, el) {

		if( index == 0 ){
			$(this).addClass('activated')
			$(this).css('height','42px' )
			gotToPage($(this).data('page'))
		}else{
			$(this).removeClass('activated')
			$(this).css('height','42px' )
		}
	});
}
function gotToPage(page_name){
	$('.leftSideBar').removeClass('translateToLeft active')
	$('.mobileMenu').removeClass('translateToLeft')
	$('.container').removeClass('translateToLeft')
	$('.titlesGroup').removeClass('translateToLeft')
	$('.loading').addClass('active')
	window.history.pushState(null,null,page_name.replace('?ajax=true',''), 'urlPath');
	$.ajax({
        type: 'GET',
        url: page_name,
        dataType:"html",
        success: function(result){
        	$('.container').empty();
	        $('.container').append(result)
	        activateSwiper()           
        },
        beforeSend: function( xhr ){
        	//console.log(xhr)
        },
        complete:function(result){
        	$('.container').animate({
        		scrollTop: 0
      		}, 1400, function(){});
        	if( result.status == 200 ){
        		setTimeout(function(){
        			var clone = $('.container').find('.loading').clone()
					$('.container').append(clone)
					$('.loading').removeClass('active')
        		},400)
        		
        	}		
        	
        },
        error:function(result){
            console.log(result)
        }
    });
}
function activateSwiper(){
	var swiper = new Swiper('.swiper-container', {
		spaceBetween: 0,
		loop:true,
		speed:600,
		navigation: {
			nextEl: '.btn.next',
			prevEl: '.btn.prev',
		},
		pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	        renderBullet: function (index, className) {
	          return '<span class="' + className + '">' + (index + 1) + '</span>';
	        },
	      },
	});
	iframeViemoFunction()
}
function iframeViemoFunction(){
	$('.imgContainer').click(function(){
		if( $(this).parent().find('.videoWrapper').length >  0 ){
			var iframe = $(this).parent().find('.videoWrapper').find('iframe');
			var player = new Vimeo.Player(iframe);
			$(this).parent().find('.videoWrapper').addClass('active')
			player.play()
		}
		
	})
}