$(document).ready(function() {
	if( $(".dragAnDropContainer#secondList").find('.item').length > 0 ){
		$(".dragAnDropContainer").shapeshift();
	}else{
		$(".dragAnDropContainer").shapeshift({
			colWidth:250
		});
	}
	
	$(".dragAnDropContainer#secondList").on("ss-added",function(event,element){
		localStorage.removeItem('itemValue')
		selectImageType(element)
		$(element).addClass('item')
		$(element).removeAttr("data-type");
		$(element).attr('data-type',localStorage.getItem('itemValue'))
		$(element).append('<a href="#" class="deleteElementFromDragAndDropContainer" >X</a>')
		$(element).parent().trigger("ss-rearrange")
	})
	
	$('body').on('click','.deleteElementFromDragAndDropContainer',function(){
		var parentDiv = $(this).parent().parent()
		$(this).parent().remove();
		$(".dragAnDropContainer#secondList").trigger("ss-rearrange")
		setNewValueInJsonFormat($(".dragAnDropContainer#secondList"))
	})
	$(".dragAnDropContainer#secondList").on("ss-rearrange",function(event,element){
		setNewValueInJsonFormat($(this))

	})
	$(".dragAnDropContainer#secondList").on("ss-drop-complete",function(event,element){
		$(".dragAnDropContainer#secondList").trigger("ss-rearrange")
		setNewValueInJsonFormat($(this))
	})
	$(".dragAnDropContainer#secondList").trigger("ss-rearrange")
	// $('.addNewImageToDragAndDrop').click(function(){
		
	// })
})