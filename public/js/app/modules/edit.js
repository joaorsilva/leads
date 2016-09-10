
function validate() {
    
    var validated = true;
    var name = $('#form-name').val();
    if(name.trim() === '') {
        //TODO: Error translation
        //TODO: Perhaps collect it via ajax.
        setFormFieldError('form-name','This fied can\'t be empty!',false);
        validated = false;
    } else {
        setFormFieldError('form-name','',true);
    }
    return validated;
}

function setRecordData(data) {
    $('#form-id').val(data.id);
    $('#form-name').val(data.name);
    $('#form-key').val(data.key);
    if(data.active > 0) {
        $('#form-active').attr('checked',true);
    } else  {
        $('#form-active').attr('checked',false);
    }
    if(data.deleted > 0) {
        $('#form-deleted').attr('checked',true);
    } else  {
        $('#form-deleted').attr('checked',false);
    }
    $('#form-created_by').val(data.created_by);
    $('#form-created_date').val(data.created_date);
    $('#form-updated_by').val(data.updated_by);
    $('#form-updated_date').val(data.updated_date);
    $('#form-deleted_by').val(data.deleted_by);
    $('#form-deleted_date').val(data.deleted_date);
}



