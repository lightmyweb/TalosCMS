$(document).ready(function(){
	$(function  () {
        $(".orderPubLictionperTheme").sortable({ 
            stop: function(event, ui) {
                $('.publicationsOrderElement').each(function(index, el) {
                	var index_ = $(this).index()
                	var route = $(this).data('path')
                	route = route.replace('element',index_)
                    updatePublicationPositionInOneTheme( route,$(this) )
                });
            },
        });
    });
})