$(document).ready(function () {
    //Init Function
    var  moz= (navigator.userAgent.toString().toLowerCase().indexOf("firefox") != -1);
    onInitFunction()
     
    // Slug Script
    $( ".theSlugInutWilTakeThisInputValue" ).each(function( index ) {
        var parent_index = index;
        $(this).on('input',function(){
            var finalSlug = slugItem( $(this).val() )
            $( ".slugInputFromOriginalTextInput" ).each(function( index ) {
                var child_index = index;
                if(child_index == parent_index ){
                    var realvalue = null;
                    var entity = $(this).data('entity');
                    var value = convertToSlug( finalSlug );
                    var route = $('body').find('.container_box').data('change')
                    
                    route = route.replace('999-entity',entity);
                    route = route.replace('888-slug',value);
                    checkSlugValidation(route,entity,$(this)); 
                    $(this).val(finalSlug)
                }
            });
        })
    });

    $('.slugTestIfExistInDatabase').change(function(){
        if ( $(this).val() != '' ){
            
            var realvalue = null;
            var entity = $(this).data('entity');
            var value = convertToSlug( $(this).val() );
            var route = $('body').find('.container_box').data('change')
            
            route = route.replace('999-entity',entity);
            route = route.replace('888-slug',value);
            realvalue = $(this).val()
            
            localStorage.setItem('realvalue',realvalue)
            checkSlugValidation(route,entity,$(this));        
        }
       
    })
 
    // DELETE BOX
    $('body').on('click', '.box_delete_btn', function(){
        var confirm = confirm("veuillez confirmer votre action");
        if ( confirm == true  ){
            $(this).parent().parent().parent().remove()
        }  
        initTinyMCE();
        return false;
    }) 
    // CLOSE BOX
    $('body').on('click', '.box_close_btn', function(){
        $(this).find('i').toggleClass('fa-sort-down fa-sort-up')
        $(this).parent().parent().parent().toggleClass('box_closed')  
    })

    // CHNAGE TIMELINEPART
    $('.time_line').find('.part').click(function(event) {
        var target = $(this).data('target');  
        removeAllActivepartInTimeLine ();
        findIdenticalPart(target);
        $(this).parent().find('.part').each(function(index, el) {
            $(this).removeClass('active')
        });
        $(this).addClass('active')
    });

    //Elements Generator 
    $('body').on('click', '.contentElement', function(){
        if  (!moz){
            event.preventDefault();
        }
        $(this).data('index', indexParent + 1);
        
        var data = $(this).data('json');
        if( typeof data == 'string' ){
            data = JSON.parse(data)
        }

        var id_panel = makeid()
       
        var elementType = data.entity
        var prototype = data.prototype
        
        var type = data.type
        var label = data.label
        
        var role = data.role;
        var current_div_class = data.current_div_class;
        
        var count = 0;
        var indexParent;
        
        var form;
        var element_id;
        
        var content;
        var lastChild

        if( data.current_div_class === 'accordionItems' ){
            count = $('.'+current_div_class).find('.panel[data-role="'+data.role+'"]').length  
            indexParent = count
            form = prototype.replace(/__name__/g, indexParent);
            console.log(indexParent);
        }else{
            count = $(this).parent().parent().find('.sub_line_childrenContent').find('.panel[data-role="'+data.role+'"]').length  
            indexParent = count
            form = prototype.replace(/__child_prot__/g, indexParent);
        }
        
        if( data.children !== null && data.children.length > 0 ){
            
            for (var i = 0; i < data.children.length ; i++) {
                data.children[i].prototype = data.children[i].prototype.replace(/__name__/g, indexParent)
            }

            form = _appendWhereToAddChildren(form)
            form = _appendWhereToAddBtnToCreateChildren(form, data.children)
        }
        element_id = generate_element_id(id_panel,type,count);
        content = generateContentBloc( element_id, label, form, data.role );

        if( data.current_div_class != 'accordionItems' ){
            $(this).parent().parent().find('.sub_line_childrenContent').append(  content )
            lastChild = $(this).parent().parent().find('.sub_line_childrenContent').find('.panel:last[data-role="'+data.role+'"]').find('input.blocPosition'); 
        }else{
            $('.'+current_div_class).append(  content )
            lastChild = $('.'+current_div_class).find('.panel:last').find('input.blocPosition[data-role="'+data.role+'"]'); 
        }

        afterAppendFunction(lastChild,indexParent) 
        initTinyMCE();
    });

    /*********************/

    //Delete Box
    $('body').on('click', '.delete_panel', function(){
        var result = confirm("Confimez votre action");
        if ( result == true ){
            $(this).parent().parent().parent().addClass('removed')
            $(this).parent().parent().parent().remove()
        }
        return false;         
    })

    //Toggle Panel
    $('body').on('click', '.toglle_panel', function(){
        $(this).find('i').toggleClass('fas fa-chevron-down fas fa-chevron-up'); 
        $(this).parent().parent().parent().toggleClass('closed');
        return false;
    })

    // Submit Function Test
    $('.submitResetModifBtnsSection').find('.btn-submit').click(function(event) {
        var count = 0;
        $('.container_wrapper').find('form').find('.required_class').each(function(){
            if ( $(this).val() == '' && $(this).attr('required') == 'required'  ){
                var placeholder  = $(this).attr('placeholder')
                var number = placeholder.search("obligatoire");
                if( number  == -1 ){
                    placeholder = placeholder + " [ ce champ est obligatoire ] "
                }
                $(this).attr('placeholder',placeholder)
                $(this).addClass('active')
                count ++
            }
        })
        if ( count > 0 ){
            errorAlert('empty_inputs')
            return false
        }
    });

    //Multilangue Function
    $('.customTabButton').click(function(){
        $(this).addClass("active")
        var lang = $(this).data('display');
        $('.customTabButton').each(function(){
            $(this).removeClass("active")
            if( $(this).data('display') == lang ){
                $(this).addClass("active")
            }
        })        
        $( ".customTabContent" ).each(function( index ) {
            $(this).removeClass('active')
            if( $(this).hasClass(lang) ){
                $(this).addClass('active')
            }
        });
        $( ".pictoImg" ).each(function( index ) {
            $(this).removeClass('active')
            if( $(this).hasClass(lang) ){
                $(this).addClass('active')
            }
        });
        return false;
    })

    $('body').on('change','.date_class_test_if_is_valide',function(){
        var value = $(this).val()
        var date = new Date( Date.parse(value) ) 
        var month = date.getFullYear()
        if ( month.toString().length != 4){
            errorAlert('errorDate');
        }
    })

    updateBoxPosition()



}); 