$(document).ready(function() {

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

        var href = $(e.target).attr('href');
        var $curr = $(".process-model  a[href='" + href + "']").parent();

        $('.process-model li').removeClass();

        $curr.addClass("active");
        $curr.prevAll().addClass("visited");
    });
    $('#_state').click(function() {
        if( $(this).hasClass("on-line") ){
            $(".select_ctrl_state").val("0")
            $(this).removeClass('on-line')
            $(this).addClass('off-line')
        }else{
            $(".select_ctrl_state").val("1")
            $(this).removeClass('off-line')
            $(this).addClass('on-line')
        }
    })
    $('.dd-button').click(function(e){
            $(this).parent().find('ul').css('display','inline-block')
            return false;
    })
})