async function selectImageType (element) {
	const inputOptions = new Promise((resolve) => {
		setTimeout(() => {
			resolve({
				'bigPicture': 'Grande',
				'mediumPicture': 'Moyenne',
				'smallPicture': 'Petite'
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
		$(element).attr('data-type',localStorage.getItem('itemValue'))
	}else if( localStorage.getItem('itemValue') == 'smallPicture' ){
		$(element).attr('data-ss-height',3)
		$(element).attr('data-type',localStorage.getItem('itemValue'))
	}else{
		$(element).attr('data-type',localStorage.getItem('itemValue'))
	}
	setNewValueInJsonFormat($(element).parent())
}
function setNewValueInJsonFormat( element ){
	if( element.attr('id') == 'secondList' ){
		var array = [];
		element.find('div.item').each(function(index, el) {
			array.push({ 
				id:$(this).data('id'),
				position: index,
				left: parseInt($(this).css("left")),
				top:parseInt($(this).css("top")),
				type:$(this).data('type')
			})
		});
		$('body').find('textarea.result').val('')
		$('body').find('textarea.result').val(JSON.stringify(array))
	}
}