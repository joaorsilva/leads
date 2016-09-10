$(document).ready(function() {
    
    /**
     * Get requested record if not new
     */
    if($('#form-id').val() !== 'new') {
        $.ajax({
            url: $('#base-url').attr('data-url') + 'get/' + $('#form-id').val(),
            type: 'GET',
            data: null,
            dataType:'json',
            async: true,
            success: function(data) {
                console.log(data);
                if(data.rows.length > 0) {
                    $('#record').removeClass('hidden');
                    setRecordData(data.rows[0]);
                    if(data.rows[0].deleted > 0) {
                        $('#delete-record').detach();
                    }
                } else {
                    $('#record').addClass('hidden');
                    showDataError('data-none');
                }
                resetCheckboxes();
            },
            error: function() {
                showDataError('data-error');
            }
        });
    } else {
        $('#record').removeClass('hidden');
        resetCheckboxes();
    }    
    /**
     * Save record
     */
    $('#save-form').click(function(e) {
        e.preventDefault();
        
        $('#form-id').attr('disabled', false);
        $('#data-error').addClass('hidden');
        
        if(!validate())
            return false;

        setButtonsStatusSave(true);
        
        var data = $('#record').serialize();
        $.ajax({
            url: $('#record').attr('action'),
            type: 'POST',
            data: data,
            dataType:'json',
            async: true,
            success: function(data) {
                if(data.error.length > 0) {
                    $.each(data.error, function(key,val){
                        //TODO: Error printing
                    });
                } else {
                    window.location = $('#base-url').attr('data-url');
                }               
                setButtonsStatusSave(false);
            },
            error: function() {
                showDataError('data-error');
                setButtonsStatusSave(false);
            }
        });        
    });
    
    /**
     * Delete record
     */
    $('#btn-delete').click(function(e) {
        $('#data-error').addClass('hidden');
        $.ajax({
            url: $('#btn-delete').attr('data-url') + $('#form-id').val(),
            type: 'GET',
            data: null,
            dataType:'json',
            async: true,
            success: function(data) {
                if(data.result && data.result === 'ok') {
                    window.location = $('#base-url').attr('data-url');
                }
            },
            error: function() {
                showDataError('data-error');
                $('#dialog-delete').modal('hide');
            }
        });
    });
    
});

function showDataError(type) {
    $('#data-error > h4 > span').text($('#' + type + '-caption').text());
    $('#data-error > p').text($('#' + type + '-text').text());
    $('#data-error').removeClass('hidden');
    //TODO: Add has-error class
}

function resetCheckboxes() {
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_minimal-yellow',
        radioClass: 'iradio_minimal',
        increaseArea: '20%' // optional
    });    
}

function setFormFieldError(fiedId,message,unset) {
    if(unset) {
        $('#' + fiedId + '-error').text('');
        $('#' + fiedId).parent('div').removeClass('has-error');
    } else {
        $('#' + fiedId + '-error').text(message);
        $('#' + fiedId).parent('div').addClass('has-error');        
    }
}

function setButtonsStatusSave(saveStatus) {
    if(saveStatus) {
        $('.box-footer > .btn').addClass('disabled').attr('disabled',true);
        var icon = $(this).find('i');
        icon.removeClass('fa-save').addClass('fa-refresh').addClass('fa-spin');    
    } else {
        $('.box-footer > .btn').removeClass('disabled').attr('disabled',false);
        var icon = $(this).find('i');
        icon.addClass('fa-save').removeClass('fa-refresh').removeClass('fa-spin');    
    }
}


