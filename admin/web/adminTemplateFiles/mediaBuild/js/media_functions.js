 function getWidthAndHeigth(route){
     $.ajax({ 
        url: route,
        dataType: "json",
        type:'GET',
        success: function (data) {
            console.log(data)
            if (data.result == 1){
                localStorage.setItem('optimalWidth',data.width)
                localStorage.setItem('optimalHeigth',data.heigth)

            }
        },
        error: function (request,error){
        }       
    });    
}
function displayImageAfterUpload(element,event){
    var reader = new FileReader();
    var img = document.createElement("img");
    var imageUrl;
    var outputElement;
    var data = '<div class="uploadedImageDivision">';
    data = data + '<div class="displayImageAfterUpload"></div>';
    data = data + '<button class="cropUploadedImage">Modifier l\'image</button>';
    data = data + '</div>';
    element.parent().parent().find('.uploadedImageDivision').remove();
    element.parent().parent().append(data)
    outputElement = element.parent().parent().find('.uploadedImageDivision');
    outputElement.find('.displayImageAfterUpload').empty();
    reader.onload = function(){
        img.src  = reader.result;
        outputElement.find('.displayImageAfterUpload').append(img)
    }
    reader.readAsDataURL(event.target.files[0]);
}
function simpleAjaxSendFunction(data){
    var clickedPart = null;
    $('.fileUploadTriggerDiv').each(function(index){
        if( $(this).data('id') == localStorage.getItem('btnClicked')){
            clickedPart = $(this)
        }
    })
    if( localStorage.getItem('mediaBox') == 1 ){
        $.ajax({
            type: 'POST',
            url: localStorage.getItem('action'),
            data: data,
            contentType: false,
            cache: false,
            processData:false,
            dataType:"json",
            success: function(result){
                $('.addImage').find('a').find('i').removeClass('fa-chevron-left');
                $('.addImage').find('a').find('i').addClass('fa-plus-circle');
                mediaAjaxCall(mediaAjxUrl,0,$('body').find('.allmedias').find('.list'));
                $('.loading_part.modalLoading').removeClass('active')
                
            },
            error:function(result){
                console.log(result)
            }
        });
    }else{
        $.ajax({
            type: 'POST',
            url: localStorage.getItem('action'),
            data: data,
            contentType: false,
            cache: false,
            processData:false,
            dataType:"json",
            success: function(result){
                mediaAjaxCall(
                    mediaAjxUrl,
                    result.id,
                    $('._mediaModel').find('.box_content').find('.list')
                );
                if(clickedPart != null){
                    clickedPart.find('select').append('<option value="'+result.id+'" selected="selected">'+result.id+'</option>')
                    clickedPart.find('select').val(result.id);
                }
                $('.loading_part.modalLoading').removeClass('active')
                
            },
            error:function(result){
                console.log(result)
            }
        });
    }
    showAndHideFunction(1)
}
function sendRequestAjaxForCroppedImage(resize,data){
    resize.result({
        type: 'blob',
        size: 'original'
    }).then(function (blob) {
        var file = new File([blob], localStorage.getItem('filename'), {
          type: "image/png",
        })
        data.append('fileCroped',file)
        for (var value of data.values()) {
   console.log(value); 
}
        simpleAjaxSendFunction(data)
    });
}
function showAndHideFunction(state){
    if(state == 1){
        $('body').find('.searchForm').each(function(){
            $(this).show()
        }).show();
        $('body').find('.pagination').each(function(){
            $(this).show()
        });
    }else{
        $('body').find('.searchForm').each(function(){
            $(this).hide()
        }).show();
        $('body').find('.pagination').each(function(){
            $(this).hide()
        });
    }
    
}
function readFile(input,resultDiv,resize) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    var file, img,width,height;
    var _URL = window.URL;
    if ((file = input.files[0])) {
        img = new Image();
        img.onload = function () {
            localStorage.setItem('Width','')
            localStorage.setItem('height','')
            localStorage.setItem('Width',this.width)
            localStorage.setItem('height',this.height)
        };
        img.src = _URL.createObjectURL(file);
    }
    if( resize == false ){
      resize = new Croppie(resultDiv, {
        viewport: { 
          width: parseInt(localStorage.getItem('optimalWidth')), 
          height: parseInt(localStorage.getItem('optimalHeigth'))   
        },
        boundary: { 
          // width: 800, 
          // height:1000 
        },
        showZoomer: true,
        enableOrientation: true,
        mouseWheelZoom: 'ctrl',
        enableResize: true,
      });
    }
    reader.onload = function (e) {
        resize.bind({
            url: e.target.result,
        });
    }
    reader.readAsDataURL(input.files[0]);
    return resize
  }
}
function saveCroppedImage(resize){
    var reader = new FileReader();
    reader.onload = function (e) {
        resize.bind({
            url: e.target.result,
        });
    }
    reader.readAsDataURL(input.files[0]);
    return resize
}
function paginationFunction(){
    var options = {
        page: 8,
        pagination: true
    };
    var userList = new List('allmedias', options);
    return userList;
}
function searchINput(){
    $('body').on('keyup','.searchForm input',function(){
        var value = $(this).val().toLowerCase();
        $(".mediaBordered").filter(function() {
          $(this).toggle($(this).data('alt').toLowerCase().indexOf(value) > -1)
        });
    })
}
function deletetMediaAjaxFunction(url,element){
    $.ajax({
        type: 'GET',
        url: url,
        dataType:"json",
        success: function(data){
            if( data.result == 1 ){
                mediaAjaxCall(mediaAjxUrl,0,element);
                $('.loading_part.modalLoading').removeClass('active')
            }else{
                console.log(data)
            }
            
        }
    });
}
function editMediaAjaxFunction(image_id,element= null,url,whereToAdd){
    $.ajax({
        type: 'GET',
        url: url,
        dataType:"json",
        success: function(data){
            if( data.result == 1 ){
                if( element != null ){
                    element.removeClass('fa-plus-circle');
                    element.addClass('fa-angle-left');
                }
                displayNewImage(form_edit_route.replace("0", image_id), data.image.alt, data.image.externa_link,data.image.src,whereToAdd )
                $('.loading_part.modalLoading').removeClass('active')
            }else{
                console.log(result)
            }
            
        }
    });
}
function mediaAjaxCall(route,id = 0,WhereToAdd){
    console.log(id)
    $.ajax({ 
        url: route,
        dataType: "json",
        type:'GET',
        success: function (data) {
            appendAllImagesFunction(data,id,WhereToAdd)
            $('.loading_part.modalLoading').removeClass('active')
        },
        error: function (request,error){
        }       
    }); 
} 
function appendAllImagesFunction(elements,id,WhereToAdd){
    WhereToAdd.empty()
    var selectedClass= "notSelected";
    for (var i = elements.length - 1; i >= 0; i--) {
        if( elements[i].id == id ){
            selectedClass= "selected";
        }else{
            selectedClass= "notSelected";
        }
        var data = data + '<div class="col col_2 mediaBordered '+selectedClass+'" data-alt="'+elements[i].alt+'" data-id="'+elements[i].id+'">';
        data = data + '<div class="imgContent">';
        data = data + '<img src="'+imagebaseUrl+elements[i].src+'">';
        data = data + '</div>';
        data = data + '<div class="imgHoverContent">';
        data = data + '<div class="row centeredRow">';
            data = data + '<div class="col col_3">';
            data = data + '<i class="fas fa-edit editMediaIcon" data-id="'+elements[i].id+'"></i>';
            data = data + '</div>';
            
            data = data + '<div class="col col_3">';
            data = data + '<i class="fas fa-trash-alt deleteMediaIcon" data-id="'+elements[i].id+'"></i>';
            data = data + '</div>';

            data = data + '<div class="col col_3">';
            data = data + '<i class="fas fa-check-circle selectMediaIcon" data-id="'+elements[i].id+'"></i>';
            data = data + '</div>';
        data = data + '</div>';
        data = data + '</div>';
        data = data + '</div>';
    }
    WhereToAdd.append(data)
    paginationFunction();
    setimageDesplayedWhenSelected(WhereToAdd)
    $('.loading_part.modalLoading').removeClass('active')

}
function setimageDesplayedWhenSelected(WhereToAdd){
    var clickedPart = null;
    var image = null;
    $('.fileUploadTriggerDiv').each(function(index){
        if( $(this).data('id') == localStorage.getItem('btnClicked')){
            clickedPart = $(this)
        }
    })
    WhereToAdd.find('.mediaBordered').each(function(){
       if( $(this).hasClass('selected') ){
            image = $(this).find('img').clone()
       }
    })
    if( clickedPart != null && image != null  ){
        clickedPart.parent().parent().find('.imgContainer').empty();
        clickedPart.parent().parent().find('.imgContainer').append( image )
        clickedPart.parent().parent().find('.imgContainer').append('<a class="btn-delleteFile" >Supprimer l\'image</a>')
    }
    
 
}
function displayNewImage(form_route,title = '', external_link = '', image = '',element = ''){
    if( external_link == null ){
        external_link = ''
    }
    if( title == null ){
        title = ''
    }
    
    element.empty()
    var data = '<div class="row">';
    data = data + '<div class="col col_12">';
    data = data + '<form method="post" data-action="'+form_route+'" class="mediaForm" enctype="multipart/form-data">';
    
    data = data + '<div class="form_group"> ';           
    data = data + '<label class="input_label required">Fichier (*)</label>';
    if( image != '' ){
       data = data + '<div class="image">'; 
       data = data + '<img src="'+imagebaseUrl+image+'">'; 
       data = data + '</div>'; 
    }  
    data = data + '<div class="fileButtonCovered" data-label="Importer une image"><input type="file" name="src" class="file"></div>';
    //data = data + '<div id="resizer-demo"><button>Enregistrer et fermer</button></div>';
    // data = data + '<div class="row onResizeShow">';
    // data = data + '<div class="col col_5"><input type="number" class="heightReSize optinalInput" placeholder="height"><span>px</span></div>';
    // data = data + '<div class="col col_5"><input type="number" class="widthReSize optinalInput" placeholder="width"><span>px</span></div>';
    // data = data + '</div>';
    data = data + '</div>';
    
    data = data + '<div class=""> ';           
    data = data + '<div class="input_box">';
    data = data + '<input type="text" id="title" name="title" required="required" class= required_class " placeholder="Titre Alternatif(*)"  maxlength="255" value="'+title+'">';
    data = data + '</div>';
    data = data + '</div>';

    // data = data + '<div class="">    ';        
    // data = data + '<div class="input_box">';
    // data = data + '<input type="text" id="externalLink" name="externalLink"   placeholder="Lien externe"  maxlength="255" value="'+external_link+'">';
    // data = data + '</div>';
    // data = data + '</div>';

    data = data + '<div class="">    ';        
    data = data + '<div class="input_box">';
    data = data + '<input type="submit" name="submit" class="btn btn-danger submitBtn" value="Enregistrer"/>';
    data = data + '</div>';
    data = data + '</div>';
    
    data = data + '</form>';
    data = data + '</div>';  
    
    data = data + '</div>';
    
    element.append(data)
    $('.loading_part.modalLoading').removeClass('active')
}