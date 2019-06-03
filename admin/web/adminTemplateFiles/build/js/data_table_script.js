$(document).ready(function() {
	$.extend( $.fn.dataTable.defaults, {
        searching: false,
        ordering:  false,
        paging:false,
    } );
    $('#table').DataTable({
        language: {
            url: '/localisation/fr_FR.json'
        }
    });
    $('.tablesTabs').find('button').click(function(event) {
        var value = $(this).data('value');
        if ( value === 'all' ){
            $('table').find('tbody').find('tr').each(function(){
                $(this).show()
            })  
        }else{
            $('table').find('tbody').find('tr').each(function(){
                if ( $(this).data('value') == value ){
                    $(this).show()
                }else{
                    $(this).hide()
                }
            })
        }
    });

    $('.affectUser').click(function(event) {
        var use_value = $(this).parent().find('select').find('option:selected').attr('value')
        var route = $(this).parent().data('route')
        route = route.replace('777-user',use_value)
        affectUserFunction(route,$(this).parent())
        console.log(route)
        return false;
    });

    $('.affecTheme').click(function(event) {
        var use_value = $(this).parent().find('select').find('option:selected').attr('value')
        var route = $(this).parent().data('route')
        route = route.replace('777-theme',use_value)
        affectThemeFunction(route,$(this).parent())
        return false;
    });

    $('.entity_delete').click(function(event) {
        var result = confirm('Veuillez confirmer votre action')
        if(result){
           var route = $(this).data("href")
            deleteEnitityElementFunction(route,$(this)) 
        }
    });
});