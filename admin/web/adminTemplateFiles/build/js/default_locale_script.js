$(document).ready(function() {
	$('.localeAction').click(function(event) {
		var result = confirm('Veuillez confirmez votre action')
		if (result){
			$('.loading_part').addClass('active')
			var route = $(this).data('href')
			generleLocaleFunction(route)
		}
		return false;
	});
});