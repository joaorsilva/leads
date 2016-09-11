$(document).ready(function(){
    $('#form-login').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: data,
            dataType:'json',
            async: true,
            success: function(data) {
                console.log(data);
                if(data.result == 'ok') {
                    window.location = data.message;
                    return;
                }
                
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
});


