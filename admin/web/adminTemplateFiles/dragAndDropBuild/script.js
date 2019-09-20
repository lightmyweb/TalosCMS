$(document).ready(function() {
	$('body').on('click','.deleteElementFromDragAndDropContainer',function(){
		if( confirm('Veuillez confirmez votre action') ){
			var parentDiv = $(this).parent().parent()
			$(this).parent().remove();
			$(".dragAnDropContainer#secondList").trigger("ss-rearrange")
			setNewValueInJsonFormat($(".dragAnDropContainer#secondList"))
		}
	})
	callDragAndDropShiftFunction()
})