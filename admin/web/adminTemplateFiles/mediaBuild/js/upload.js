$(document).ready(function() {

	var resize = false;
	var clickedPart = false;
	var fileUploadElement = false;
	var partId  = 0;
	var dragAndDropBtnClicked =false;
	$('body').on('change','.file',function(event){
		resize = false;
		const file = event.target.files[0];
		$(this).parent().removeClass('danger')
		$(this).parent().attr('data-label','Importer une image')
		displayImageAfterUpload($(this), event)
		fileUploadElement = this
		$('.uploadedImageDivision').show()
		if( this.files[0].size >  2000000  ){
			alert('Veillez réduire la taille de l\'image avant de l\'uploader ( taille optimale  < 1MO ) ')
			
		}else if( this.files[0].size <  2000000 && this.files[0].size > 999999 ){
			$('.cropUploadedImage').trigger('click')
		}
		
	});	
	$('body').on('click','#resizer-demo button',function(event){
		event.preventDefault();
		if( $(this).hasClass('cancel') ){
			$('body').find('#resizer-demo').removeClass('active')
			resize = false;
		}else{
			$('body').find('#resizer-demo').removeClass('active')
			resize.result({
	        	type: 'base64'
		    }).then(function (blob) {
		    	$('body').find('.uploadedImageDivision').find('.displayImageAfterUpload').find('img').attr('src',blob)
		    });
		}
		
		
		return false;
	});	
	$('body').on('click','.cropUploadedImage',function(event){
		event.preventDefault();
		resize = false;
		$('.loading_part.generale').addClass('active')
		resize = readFile(fileUploadElement,document.getElementById('resizer-demo'),resize); 
		localStorage.setItem('filename',fileUploadElement.files[0].name)

		setTimeout(function(){ 
			$('.loading_part.generale').removeClass('active')
			$('body').find('#resizer-demo').addClass('active')
			$('body').find('#resizer-demo').append('<button class="cancel">Annuler</button>')
		}, 1000);
		return false;
	});	
	$('.fileUploadTrigger').each(function(index, el) {
		var label = $(this).data('label')
		var parent = $(this).parent()
		parent.addClass('fileUploadTriggerDiv')		
		parent.attr('data-label',label)
		parent.attr('data-id',partId + 1)
	});
	$('body').on('click','.addNewImageToDragAndDrop',function(e){
		clickedPart = $(this)
		dragAndDropBtnClicked = true
		$('.blockRow').addClass('active')
		$('._mediaModel').addClass('active')
		$('.loading_part.modalLoading').addClass('active')
		if( $(this).find('select').val() != '' ){
			mediaAjaxCall(
				mediaAjxUrl,
				-1,
				$('._mediaModel').find('.box_content').find('.list')
			)
		} 
		return false;
	})
	$('body').on('click','.fileUploadTriggerDiv',function(e){
		if($(this).parent().find('.imgContainer').length == 0 && $(this).parent().parent().parent().find('.imgContainer').length == 0){
			$(this).parent().append('<div class="form_group imgContainer" style="margin-left:20px;"></div>');
		}
		clickedPart = $(this)
		localStorage.setItem('btnClicked',$(this).data('id'))
		$('.blockRow').addClass('active')
		$('._mediaModel').addClass('active')
		$('.loading_part.modalLoading').addClass('active')
		if( $(this).find('select').val() != '' ){
			var val = $(this).find('select').val()
			mediaAjaxCall(
				mediaAjxUrl,
				val,
				$('._mediaModel').find('.box_content').find('.list')
			);
		}else{
			mediaAjaxCall(
				mediaAjxUrl,
				0,
				$('._mediaModel').find('.box_content').find('.list')
			);
		}
	})
	$('body').on('click','.closeMediaModal',function(){
		$('._mediaModel').find('.box_content').find('.list').empty();
		$('._mediaModel').removeClass('active')
		$('.blockRow').removeClass('active')
	})
	$('body').on('click','._mediaModel .selectMediaIcon',function(){
		$(this).parent().parent().parent().parent().addClass('selected')
		var clone = $(this).parent().parent().parent().parent().find('img').clone()
		if( dragAndDropBtnClicked != true ){
			$('._mediaModel .mediaBordered').each(function(index, el) {
				$(this).removeClass('selected')
			});
			clickedPart.find('select').val($(this).data('id'));
			clickedPart.parent().parent().find('.imgContainer').empty();
			clickedPart.parent().parent().find('.imgContainer').append( clone )
			clickedPart.parent().parent().find('.imgContainer').append('<a class="btn-delleteFile" >Supprimer l\'image</a>')
		}else{
			

			var contentToInsert = '<div class="addedFromImage"  data-id="'+$(this).data('id')+'" ></div>'
			$('#secondList').append(contentToInsert)
			$('#secondList div[data-id="'+$(this).data('id')+'"]').last().append(clone)
			callDragAndDropShiftFunction()
			_callDragAndDropThingFunction($('#secondList div[data-id="'+$(this).data('id')+'"]').last())
			setNewValueInJsonFormat($('#secondList'))
			dragAndDropBtnClicked = false;
		}
		$('.blockRow').removeClass('active')
		$('._mediaModel').removeClass('active')
		$('.loading_part.modalLoading').removeClass('active')
		return false;
	})
	$('body').on('click','._mediaModel .newFormModal',function(){
		$('.loading_part.modalLoading').addClass('active')
		if( $(this).parent().find('i').hasClass('fa-plus-circle') ){
			$(this).parent().find('i').removeClass('fa-plus-circle');
			$(this).parent().find('i').addClass('fa-angle-left');
			displayNewImage(
				form_route,
				'',
				'',
				'',
				$('._mediaModel').find('.box_content').find('.list')
			)
			showAndHideFunction(0)
		}else{
			$(this).parent().find('i').removeClass('fa-angle-left');
			$(this).parent().find('i').addClass('fa-plus-circle');
			mediaAjaxCall(
				mediaAjxUrl,
				clickedPart.find('select').val($(this).data('id')),
				$('._mediaModel').find('.box_content').find('.list') 
			);
			showAndHideFunction(1)
		}
	})
	$('body').on('click','.addImage',function(){
		var action = $(this).find('a').data('href')
		$('.loading_part.modalLoading').addClass('active')
		
		if( $(this).find('a').find('i').hasClass('fa-plus-circle') ){
			$(this).find('a').find('i').removeClass('fa-plus-circle');
			$(this).find('a').find('i').addClass('fa-chevron-left');
			displayNewImage(action,'','','',$('body').find('.allmedias').find('.list'))
			showAndHideFunction(0)
		}else{
			$(this).find('a').find('i').removeClass('fa-chevron-left');
			$(this).find('a').find('i').addClass('fa-plus-circle');
			mediaAjaxCall(mediaAjxUrl,0,$('body').find('.allmedias').find('.list'));
			showAndHideFunction(1)
		} 	
	})
	$('body').on('submit','.mediaForm',function(e){
	  	e.preventDefault();
	  	var data = new FormData(this)
	  	localStorage.setItem('action',$(this).data('action'))
	  	localStorage.setItem('mediaBox',0)
	  	$('.loading_part.modalLoading').addClass('active')
	  	if ( $('.container_box').hasClass('mediaBox') ){
	  		localStorage.setItem('mediaBox',1)
	  	}
	  	if( resize !== false ){
			data.delete('src')
	  		sendRequestAjaxForCroppedImage(resize,data)

	  	}else{
	  		simpleAjaxSendFunction(data)
	  	}
	  	
	    return false
	});
	$('body').on('click','.editMediaIcon',function(e){
	  	e.preventDefault();
	  	if( $('.container_box').hasClass('mediaBox') ){
	  		var image_id = $(this).data('id');
			var url = mediaOneAjaxUrlForEdit.replace("0", image_id);
			$('.addImage').find('a').find('i').removeClass('fa-plus-circle');
			$('.addImage').find('a').find('i').addClass('fa-chevron-left');
			$('.loading_part.modalLoading').addClass('active')
			editMediaAjaxFunction(image_id,$('._mediaModel').find('i'),url,$('body').find('.allmedias').find('.list') )
	  	}else{
	  		$('.loading_part.modalLoading').addClass('active')
		  	var image_id = $(this).data('id');
		  	var url = mediaOneAjaxUrlForEdit.replace("0", image_id);
			editMediaAjaxFunction(
				image_id,
				$('._mediaModel').find('i'),
				url,
				$('._mediaModel').find('.box_content').find('.list') 
			)
	  	}
	  	
	    return false
	});
	$('body').on('click','.deleteMediaIcon',function(e){
		var image_id = $(this).data('id')
		var url = form_delete_route.replace("0", image_id);
		$('.loading_part.modalLoading').addClass('active')
		deletetMediaAjaxFunction(url,$('body').find('.allmedias').find('.list'))
		mediaAjaxCall(mediaAjxUrl,0,$('body').find('.allmedias').find('.list'));
	});
	$('body').on('click','.btn-delleteFile',function(e){
	  	e.preventDefault();
	  	$(this).parent().find('img').remove()
	  	$(this).parent().parent().find('select').val('')
	  	$(this).remove();
	    return false
	});
	searchINput();
	paginationFunction();
});