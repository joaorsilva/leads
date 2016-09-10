$(document).ready(function(){
   
});

function cloneRow(data) {
    var originalRow = $('#row-template');
    $.each(data,function(index,valueData) {
        var newRow = originalRow.clone(true,true);
        newRow.attr('id',null);
        newRow.removeClass('hidden');
        newRow.addClass('dynamic-row');
        var tds = newRow.find('td');
        $.each(tds, function(index,element){
            switch(index) {
                case 0: //checkbox
                    var input = $(element).find('input');
                    input.attr('name','select[' + valueData.id + ']');
                    input.val(valueData.id);
                    break;
                case 1: //id
                    $(element).text(valueData.id+'');
                    break;
                case 2: //name
                    $(element).text(valueData.name);
                    break;
                case 3: //created_by
                    $(element).text(valueData.created_by);
                    break;
                case 4: //created_date
                    $(element).text(valueData.created_date);
                    break;
                case 5: //updated_by
                    $(element).text(valueData.updated_by);
                    break;
                case 6: //updated_date
                    $(element).text(valueData.updated_date);
                    break;
                case 7: //status
                    var span = $(element).find('span');
                    if(valueData.deleted === "1") {
                        span.addClass('label-danger');
                        span.text('Deleted');
                    } else if (valueData.active === "0") {
                        span.addClass('label-warning');
                        span.text('Inactive');                            
                    } else {
                        span.addClass('label-success');
                        span.text('Active');
                    }
                    break;
                case 8:
                    var buttons = $(element).find('div > a');
                    buttons.attr('data-id',valueData.id);
                    $.each(buttons,function(index,element){
                        var href = $(this).attr('href');
                        $(this).attr('href',href + valueData.id);
                    });
                    if(valueData.deleted === "1" ) {
                        var btn = $(element).find('div > a.btn-danger');
                        btn.addClass('disabled');
                    }
            }
        });
        $('#row-single').addClass('hidden');
        $('#list > tbody').append(newRow);
    });
}
