$(document).ready(function() {
	var path = window.location.pathname;
	var pathNumber = 0
	$('.menu').find('a').each(function(){
		if( $(this).find('ul').length == 0 && $(this).data('page') == path+'?ajax=true' ){
			$(this).parent().addClass('active')
			
		}else{
			pathNumber++
		}
	})
	if( pathNumber > 0 ){
		$('nav').addClass('active')
		$('.menu').find('.secondLevel').each(function(){
		if( $(this).data('page') == path+'?ajax=true' ){
				var height =calculatesubLiForheigth($(this).parent().parent())
				$(this).parent().parent().addClass('active')

				$(this).parent().parent().css('height',height)
				$(this).addClass('activated')
			}
		})
	}
	$('.logo').click(function(){
		var page = $(this).data('page')
		gotToPage(page)
	})
	
	$('body').on('click','.classicRouter',function(e){
		var page = $(this).data('page')
		$('.firstLevel').parent().parent().find('.firstLevel').parent().each(function(index, el) {
			$(this).removeClass('active')
			$(this).css('height','42px' )
		});
		gotToPage(page)
	});
	$('.linkfrom404').click(function(){
		var page = $(this).data('href')
		gotToPage(page)
	})
	$('.firstLevel').click(function(event) {
		var height = calculatesubLiForheigth($(this).parent())
		var page = $(this).data('page')
		$('.firstLevel').parent().parent().find('.firstLevel').parent().each(function(index, el) {
			$(this).removeClass('active')
			$(this).css('height','42px' )
		});
		$(this).parent().addClass('active')
		$(this).parent().css('height',height+'px' )
		if( page != undefined ){
			gotToPage(page)
			
		}
		if( height != 42 ){
			activateFirstChild($(this).parent())
			$('nav').addClass('active')
			$(this).parent().addClass('withSbMenu')
		}else{
			$('nav').removeClass('active')
		}
	});	
	$('.secondLevel').click(function(event){
		var page = $(this).data('page')
		$('.secondLevel').parent().find('.secondLevel').each(function(index, el) {
			$(this).removeClass('activated')
		});
		gotToPage(page)
		$(this).addClass('activated')
	})
	$('body').on('click','.galleryPageFormat .element',function(){
		var page = $(this).data('page')
		gotToPage(page)
	});
	$('body').on('click','.toAllAlbums',function(){
		var page = $(this).data('page')
		gotToPage(page)
	});
	$('body').on('click','.burger',function(){
		
		if( $('.leftSideBar').hasClass('translateToLeft') ){
			$('.leftSideBar').removeClass('translateToLeft active')
			$('.mobileMenu').removeClass('translateToLeft')
			$('.container').removeClass('translateToLeft')
			$('.titlesGroup').removeClass('translateToLeft')
		}else{
			$('.leftSideBar').addClass('translateToLeft active')
			$('.mobileMenu').addClass('translateToLeft')
			$('.container').addClass('translateToLeft')
			$('.titlesGroup').addClass('translateToLeft')
		}
	});
	$('body').on('change','#type',function(){
		if( $(this).val() == '0' ){
			$(this).parent().find('label').show()
		}else{
			$(this).parent().find('label').hide()
		}
	});
	$('body').on('click','.submitForm',function(e){
		var form = $(this).parent();
		var action = form.data('action');
		var errorCounter = 0;
		form.find('.requiredInput').each(function(index, el) {
			if( $(this).find('input').val() == '' ){
				$(this).addClass('active')
				errorCounter++
				console.log('input')
			}
		});
		if( form.find('select').val() == '0' ){
			form.find('select').parent().addClass('active')
			errorCounter++
		}
		if( errorCounter == 0 ){
			$.ajax({ 
		        url: action,
		        data:form.serialize(),
		        dataType: "json",
		        type:'POST',
		        success: function (data) {
		        	console.log(data)
		        	$('body').find('p.msg-OK').addClass('active')
		        },
		        error: function (request,error){
		        	console.log(request)
		        	console.log(error)
		            // $('#error-message').addClass('active');
		        }       
		    }); 
		}
		return false
	});
	$('body').on('change','.inputText input',function(e){
		console.log($(this).val())
		if( $(this).val() != '' ){
			$(this).parent().find('label').hide()
		}else{
			$(this).parent().find('label').show()
		}
	});
	activateSwiper()
	iframeViemoFunction()
});