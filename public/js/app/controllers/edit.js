$(document).ready(function(){
    /**
     * Loads the users list for the created by filter
     */
    $('#form-app_modules_id').select2(/*{
        ajax: {
            url: '/app/modules/modules_filter',
            dataType: 'json',
            type: 'GET',
            delay: 100,
            cache: false,
            processResults: function (data) {
                return {
                    results: data
                };
            }
        },
        minimumInputLength: 0,
        tags: "false",
        placeholder: "",
        allowClear: true
    }*/);    
});

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
    
    var app_modules_id = $('#form-app_modules_id').val();
    if(!app_modules_id) {
        setFormFieldError('form-app_modules_id','You must choose a module!',false);
        validated = false;
    } else {
        setFormFieldError('form-app_modules_id','',true);
    }
    
    return validated;
}

function setRecordData(data) {
    $('#form-id').val(data.id);
    $('#form-name').val(data.name);
    $('#form-key').val(data.key);
    $('#form-app_modules_id').val(data.app_modules_id);
    $('#form-app_modules_id').trigger('change');
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

function loadModules() {
    $.ajax({
        url: '/app/modules/modules_filter',
        dataType: 'json',
        type: 'GET'
    }).done(function(data){
        console.log("modules loaded");
        html = '';
        if(data.length > 0) {
            $.each(data, function(index,element){
                html += '<option value="' + element.id + '">' + element.text + '</option>';
            });
        }
        $('#form-app_modules_id').html(html);
    });    
}

loadModules();



