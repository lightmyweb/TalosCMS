async function selectImageType (element) {
	localStorage.removeItem('itemValue')
	const inputOptions = new Promise((resolve) => {
		setTimeout(() => {
			resolve({
				'bigPicture': 'Grande 682x454px ',
				'mediumPicture': 'Moyenne 339x454px',
				'smallPicture': 'Petite 339x226px'
			})
		}, 1000)
	})
	const {value: type} = await Swal.fire({
		title: 'Selectionnez type d\'image',
		input: 'radio',
		inputOptions: inputOptions,
		inputValidator: (value) => {
			if (!value) {
				localStorage.setItem('itemValue',0)
				return 'Vous devez choisir le type de votre image';
			}else{
				localStorage.setItem('itemValue',value)

			}
		}
	})
	if( localStorage.getItem('itemValue') == 'bigPicture' ){
		$(element).attr('data-ss-colspan',2)
		$(element).attr('data-type','bigPicture')
		_shapeShift(1)
	}else if( localStorage.getItem('itemValue') == 'smallPicture' ){
		$(element).attr('data-ss-height',3)
		$(element).attr('data-type','smallPicture')
		_shapeShift(2)
	}else{
		$(element).attr('data-type','mediumPicture')
		_shapeShift(2)
	}
	if( $('#secondList').find('div').length == 1 ){
		$(element).css('left',0)
	}
	//callDragAndDropShiftFunction()
	setNewValueInJsonFormat($(element).parent())
}
function setNewValueInJsonFormat( element ){
	if( element.attr('id') == 'secondList' ){
		var array = [];
		element.find('div.item').each(function(index, el) {
				console.log($(this).data('type'))

			array.push({ 
				id:$(this).data('id'),
				position: index,
				left: _modifValue( parseInt(  $(this).css("left") ) ) ,
				top:parseInt($(this).css("top")),
				type:$(this).data('type'),
				mansoryHeight:document.getElementById("secondList").style.height
			})
		});
		$('body').find('textarea.result').val('')
		$('body').find('textarea.result').val(JSON.stringify(array))
	}
}
function _modifValue( value ){
	if (value < 11){
		return 0
	}else{
		return value - 3
	}
}
function _shapeShift(number){
	$(".dragAnDropContainer").shapeshift({
		minColumns:number,
		gutterX: 0,
    	gutterY: 0
	})
}
function callDragAndDropShiftFunction(){
	if( $(".dragAnDropContainer#secondList").find('.item').length > 0 ){
		_shapeShift(2)
	}
	 
	$(".dragAnDropContainer#secondList").on("ss-added",function(event,element){
		localStorage.removeItem('itemValue')
		_callDragAndDropThingFunction(element)
	})
	
	$(".dragAnDropContainer#secondList").on("ss-rearrange",function(event,element){
		setNewValueInJsonFormat($(this))
		_shapeShift(2)

	})
	$(".dragAnDropContainer#secondList").on("ss-drop-complete",function(event,element){
		$(".dragAnDropContainer#secondList").trigger("ss-rearrange")
		setNewValueInJsonFormat($(this))
	})
	$(".dragAnDropContainer#secondList").trigger("ss-rearrange")
}
function _callDragAndDropThingFunction(element){
		selectImageType(element)
		$(element).addClass('item')
		$(element).removeAttr("data-type");
		$(element).attr('data-type',localStorage.getItem('itemValue'))
		$(element).append('<a href="#" class="deleteElementFromDragAndDropContainer" >X</a>')
		$(element).parent().trigger("ss-rearrange")
		if( $('#secondList').find('div').length == 1 ){
			$(element).css('left',0)
		}
		
}