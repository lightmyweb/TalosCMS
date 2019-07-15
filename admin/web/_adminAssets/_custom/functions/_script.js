function checkIfhasChildren( form,data, order ){
    return form;
}
function _appendWhereToAddChildren(form){
    form = form + '<div class="sub_line_childrenContent"></div>';
    return form;
}
function _appendWhereToAddBtnToCreateChildren(form,array){
    form = form + '<div class="linechildrenBtns">';
    for( var i = 0; i < array.length ; i ++ ){
        form = form +
        '<button class="contentElement" data-json=\''+JSON.stringify(array[i])+'\'  > ';
        form = form +'Ajouter '+array[i].label+' </button>';  
    }
    form = form + '</div>';
    return form;
}
function updatePublicationPositionInOneTheme(route,element){
    $.ajax({ 
        url: route,
        dataType: "json",
        type:'GET',
        success: function (data) {
            if (data.result == 1){
                $('body').find('.Nb').find('span').addClass('active')
            }
        },
        error: function (request,error){
        }       
    }); 
}
function pnotifySuccess(){
    new PNotify({
        title: 'Success!',
        text: 'That thing that you were trying to do worked.',
        type: 'success'
    });
}
function pnotifyError(){
    new PNotify({
        title: 'Oh No!',
        text: 'Something terrible happened.',
        type: 'error'
    });
} 
function updatePositionOnEdit(){
    var $wrapper = $('.FirstLinechildrenContent');

    $wrapper.find('.panel[data-role="children"]').sort(function (a, b) {
        return +a.dataset.position - +b.dataset.position;
    })
    .appendTo( $wrapper );
}
function onInitFunction(){
    $('body').find('.tinymce').each(function(index, el) {
        $(this).parent().parent().find('label').show('slow')        
    });
    $('body').find('.a2lix_translations').each(function(index, el) {
        $(this).parent().css('border-bottom','0px')
    });
    $('body').find('.not_required_class').each(function(index, el) {
        $(this).attr('required',false)
    });
    $('.fileUploadTrigger').each(function(index, el) {
        var label = $(this).data('label')
        var parent = $(this).parent()
        parent.addClass('fileUploadTriggerDiv')        
        parent.attr('data-label',label)
    });
}
function afterAppendFunction (element,position){
    if(tinymce){
       tinymce.remove();  
    }
   
    element.val(position)
    element.parent().parent().hide();
    onInitFunction()
    updateBoxPosition()
}
function generateContentBloc(element_id,label,form, elementRole = null){
    var content = '<div class="panel" data-role="'+elementRole+'" id="'+element_id+'">'+
        '<div class="panel_header" data-role="'+elementRole+'" >'+
            '<h3>'+label+'</h3>'+
            '<div class="editpart">'+
                '<button class="toglle_panel"><i class="fas fa-chevron-up"></i></button>'+
                '<button class="delete_panel"><i class="far fa-times-circle"></i></button>'+
            '</div>'+
        '</div>'+
        '<div class="panel_content">'+ form +'</div>'+
    '</div>';
    return content;
}
function updateBoxPosition(){
    $(function  () {
        $(".accordionItems").sortable({ 
            handle: '.panel_header[data-role="parent"]',
            cancel: ".mce-tinymce, input, textarea, select",
            start: function (event, ui) {
               if( $(ui.item[0]).find('.tinymce') ){
                    //tinyMCE.execCommand( 'mceRemoveEditor', false,  jQuery('textarea',ui.item)[0].id );  
               } 
            } ,
            stop: function(event, ui) {
                $('.panel[data-role="parent"]').each(function(index, el) {
                    var panel_position = $(this).index();
                    $(this).find('.blocPosition').val(panel_position)
                    tinymce.remove();
                    initTinyMCE();
                });
            },
        });
        $('.sub_line_childrenContent').each(function(){
            var parent = $(this)
            parent.sortable({ 
                handle: '.panel_header[data-role="child"]',
                cancel: ".mce-tinymce, input, textarea, select",
                start: function (event, ui) {
                   if( $(ui.item[0]).find('.tinymce') ){
                        //tinyMCE.execCommand( 'mceRemoveEditor', false,  jQuery('textarea',ui.item)[0].id );  
                   } 
                } ,
                stop: function(event, ui) {
                    parent.find('.panel[data-role="child"]').each(function(index, el) {
                        var panel_position = $(this).index();
                        $(this).find('.blocPosition').val(panel_position)
                        tinymce.remove();
                        initTinyMCE();
                    });
                },
            });
        })
    }); 
}
function deleteEnitityElementFunction(route,element){
    $.ajax({ 
        url: route,
        dataType: "json",
        type:'GET',
        success: function (data) {
            console.log(data)
            if (data.result == 1){
                element.parent().parent().remove()
                //successAlert();
            }else{
                errorAlert('localeNoDefined')
            }
        },
        error: function (request,error){
            errorAlert('localeNoDefined')
        }       
    }); 
}
function generleLocaleFunction(route){
    $.ajax({ 
        url: route,
        dataType: "json",
        type:'GET',
        success: function (data) {
            if (data.result == 1){
                successAlert();
                location.reload();

            }else{
                errorAlert('localeNoDefined')
            }
        },
        error: function (request,error){
            errorAlert('localeNoDefined')
        }       
    }); 
}
function affectThemeFunction(route,element){ 
    $.ajax({ 
        url: route,
        dataType: "json",
        type:'GET',
        success: function (data) {
            if (data.result == 1){
                element.empty();
                element.text(data.name)
                successAlert();

            }else{
                errorAlert('localeNoDefined')
            }
        },
        error: function (request,error){
            errorAlert('localeNoDefined')
        }       
    }); 
}
function affectUserFunction(route,element){
    $.ajax({ 
        url: route,
        dataType: "json",
        type:'GET',
        success: function (data) {
            console.log(data)
            if (data.result == 1){
                element.empty();
                element.text(data.name)
                successAlert();

            }else{
                errorAlert('localeNoDefined')
            }
        },
        error: function (request,error){
            errorAlert('localeNoDefined')
        }       
    }); 
}
function convertToSlug(Text){
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}
function checkSlugValidation(route,entity,element){
    $.ajax({
        url: route,
        dataType: "json",
        type:'GET',
        success: function (data) {
            if ( data.result == 1 ){
                if ( localStorage.getItem('realvalue')  != undefined && localStorage.getItem('realvalue') != data.slug ){
                    errorAlert('slugElementExist')
                    element.val('')
                    element.addClass('required_class active')
                }     
            }
        },
        error: function (request,error){
            errorAlert('localeNoDefined')
        }       
    }); 
}
function validationAlert(){
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
}
function errorAlert(error_type){
    var message ;
    if ( error_type == 'empty_inputs' ){
        message = 'Vérifier les champs obligatoires.'
    }else if ( error_type == 'localeNoDefined' ){
        message = '' 
    }else if ( error_type == 'slugElementExist' ){
        message = 'Permalien existe deja' 
    }else if ( error_type == 'errorDate' ){
        message = 'Format Date invalide' 
    }
    Swal({
      title: 'Une Erreur s\'est produite',
      text: message,
      type: 'error',
      confirmButtonText: 'ok'
    })
}
function slugItem(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}
function removeActiveClassForSideBarmenu(){
    $('#sidebar').find('.content').find("#menu").find('li a').each(function(index, el) {
        if ( $(this).hasClass('active') ){
            $(this).children('i:last-child').toggleClass('fa-caret-down fa-caret-up');
        }
        $(this).removeClass('active')
    });
}
function removeAllActivepartInTimeLine(){
    $('body').find('.time_line').find('.part').each(function(index, el) {
        $(this).removeClass('active')
    });
}
function findIdenticalPart(target){
    $('body').find('.line').removeClass('content')
    $('body').find('.line').removeClass('generale')
    $('body').find('.line').removeClass('seo')
    $('body').find('.line').addClass(target)
    $('body').find('.time_line_target').find('.part').each(function(index, el) {
        if ( $(this).data('source') == target ){
            $(this).addClass('active')
        }else{
            $(this).removeClass('active')
        }
    });
    progressbarFunction(target)
}
function progressbarFunction(target){
    if ( target == 'generale' ){
        $('body').find('.time_line').find('.part[data-target="seo"]').removeClass('active')
        $('body').find('.time_line').find('.part[data-target="content"]').removeClass('active')
    }else if ( target == 'seo' ){
        $('body').find('.time_line').find('.part[data-target="generale"]').addClass('active')
        $('body').find('.time_line').find('.part[data-target="content"]').removeClass('active')
    }else if ( target == 'content' ){
        $('body').find('.time_line').find('.part[data-target="generale"]').addClass('active')
        $('body').find('.time_line').find('.part[data-target="seo"]').addClass('active')
    }
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function makeGenerated_id() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 5; i++){
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
} 
function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 5; i++){
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
} 
function successAlert(){
    swal(
        "Bravo !", 
        "Votre navigateur va se recharger pour enregistrer les changements", 
        "success"
    );   
}
function generate_element_id(id_panel,type,count){
    return type+'_'+count+'_'+id_panel;
}