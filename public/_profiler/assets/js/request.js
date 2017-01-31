$(document).ready(function(){
    $("#areas-menu > li").click(function(e){
        if($(this).hasClass('active'))
            return;
        $("#areas-menu > li").removeClass('active');
        $(this).addClass('active');
        $(".area").addClass('hidden');
        $($(this).attr('data-area')).removeClass('hidden');
    });
});


