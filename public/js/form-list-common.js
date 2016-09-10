$(document).ready(function(){
    
    /**
     * Checkbox initialization
     */
    $('input').iCheck({
      checkboxClass: 'icheckbox_minimal-yellow',
      radioClass: 'iradio_minimal',
      increaseArea: '20%' // optional
    });

    /**
     * Date interval filter for created_date
     */
    $('#filter-created_date').daterangepicker({
        ranges: date_ranges,
        locale: date_locale,
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    });
    
    /**
     * Date interval filter for updated_date
     */
    $('#filter-updated_date').daterangepicker({
        ranges: date_ranges,
        locale: date_locale,
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    });
    
    /**
     * Sort operation
     */
    $('#list > thead > tr > th > a').click(function(e){

        var field = $(this).attr('id');
        var direction = 'ASC';

        if($(this).find('i').hasClass('glyphicon-sort-by-attributes')) {
            direction = 'DESC';
        }
        
        $('#sort-field').val(field);
        $('#sort-direction').val(direction);

        $('#list > thead > tr > th > a > i').removeClass('glyphicon-sort-by-attributes').removeClass('glyphicon-sort-by-attributes-alt').addClass('glyphicon-sort');
        var element = $('#' + field).find('i');
        if(direction === 'DESC') {
            element.addClass('glyphicon-sort-by-attributes-alt');
        } else {
            element.addClass('glyphicon-sort-by-attributes');        
        }
        $('#form-filter').submit();
    });
    
    /**
     * Filter operation
     */
    $('#form-filter').submit(function(e) {
        e.preventDefault();
        $('.dynamic-row').remove();
        $('#row-single').find('td').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Loading...')
        $('#row-single').removeClass('hidden');
        $('#row-error').addClass('hidden');
        $('#row-no-data').addClass('hidden');
        var data = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType:'json',
            async: true,
            success: function(data) {
                if(data.rows.length > 0) { 
                    cloneRow(data.rows);
                } else {
                    $('#row-single').addClass('hidden');
                    $('#row-no-data').removeClass('hidden');
                }
                $('#default-filter').val(0);
                makePagination(data.pagination);
                makeFilter(data.filter);
                makeSort(data.sort);
                
                $('.dynamic-checkbox').iCheck({
                    checkboxClass: 'icheckbox_minimal-yellow',
                    radioClass: 'iradio_minimal',
                    increaseArea: '20%' // optional
                });
                
                $(".dynamic-checkbox").on('ifChanged',function(e){
                    if($(".dynamic-checkbox:checked") && $(".dynamic-checkbox:checked").length) {
                        $("#delete-many").removeClass("hidden");
                    } else {
                        $("#delete-many").addClass("hidden");
                    }
                });
            },
            error: function() {
                $('#row-single').addClass('hidden');
                $('#prow-error p').text(data.mesage);
                $('#row-error').removeClass('hidden');
            }
        });
        return false;
    });
    
    /**
     * Builds the pagination buttons
     */
    function makePagination(data) {
        $('.pages').remove();
        $('.pag').removeClass('disabled');
        $('.pag').removeClass('active');

        $('#row-start > b').text(data.start_row+1);
        $('#row-end > b').text(data.end_row);
        $('#row-totals > b').text(data.total_rows);
        $('#page-size').val(data.page_size);
        $('#pagination-page-size').val(data.page_size);
        
        if(data.page == 0) {
            $('#page-prev').addClass('disabled');
        }
        if(data.page == data.pages-1) {
            $('#page-next').addClass('disabled');
        }
        if(data.total_rows > 0) {
            for (i = data.end_page; i >= data.start_page; i-- ) {
                var disabled = '';
                if(data.page == i) {
                    disabled = ' disabled="disabled" ';
                }
                $('<a class="btn btn-default pag pages" id="page-number" data-page="' +  i + '" ' + disabled + '>' + (i+1) + '</a>').insertAfter('#page-prev');
            }
        } else {
            $('<a class="btn btn-default pag pages" id="page-number" data-page="0">1</a>').insertAfter('#page-prev');
        }
        $('#prev-next').attr('data-page',data.page-1);
        $('#page-next').attr('data-page',data.page+1);
    }
    
    /**
     * Sets the filter
     */
    function makeFilter(data) {
        
    }
    
    /**
     * Sets the column order
     */
    function makeSort(data) {
        $('#list > thead > tr > th > a > i').removeClass('glyphicon-sort-by-attributes').removeClass('glyphicon-sort-by-attributes-alt');
        $('#list > thead > tr > th > a > i').addClass('glyphicon-sort-by-glyphicon-sort');
        if(data[0]) {
            if(data[1] === 'DESC') {
                $('#field-'+data[0]+' > i').removeClass('glyphicon-sort-by-glyphicon-sort').addClass('glyphicon-sort-by-attributes-alt');
            } else {
                $('#field-'+data[0]+' > i').removeClass('glyphicon-sort-by-glyphicon-sort').addClass('glyphicon-sort-by-attributes');
            }
        } else {
            $('#field-id > i').removeClass('glyphicon-sort-by-glyphicon-sort').addClass('glyphicon-sort-by-attributes');
        }
    }
    
    /**
     * Retry button
     */
    $('#table-retry').click(function(){
        $('#form-filter').submit();
    });
        
    /**
     * Clears the filter to it's default
     */
    $('#filter-clear').click(function(e){
        e.preventDefault;
        $(this).closest('form')[0].reset();
        $('#filter-created_by').val(null).trigger("change");
        $('#filter-updated_by').val(null).trigger("change");
        $('#filter-status').val([1,2]).trigger("change");
        $('#filter-created_date').val("");
        $('#filter-updated_date').val("");
        $('#default-filter').val(0);
        $('#form-filter').submit();
    });
    
    /**
     * Loads the users list for the created by filter
     */
    $('#filter-created_by').select2({
        ajax: {
            url: '/app/modules/users_filter',
            dataType: 'json',
            type: 'GET',
            delay: 100,
            cache: true,
            processResults: function (data) {
                return {
                    results: data
                };
            }            
        },
        minimumInputLength: 0,
        tags: "true",
        placeholder: "Created by",
        allowClear: true
    });
    
    /**
     * Loads the users list for the updated by filter
     */
    $('#filter-updated_by').select2({
        ajax: {
            url: '/app/modules/users_filter',
            dataType: 'json',
            type: 'GET',
            delay: 100,
            cache: true,
            processResults: function (data) {
                return {
                    results: data
                };
            }            
        },
        minimumInputLength: 0,
        tags: "true",
        placeholder: "Updated by",
        allowClear: true
    });
    
    /**
     * Record status filter initialization
     */
    $('#filter-status').select2();
    $('#filter-status').val([1,2]).trigger("change");
    
    /**
     * Changes the page size
     */
    $('#page-size').change(function(e){
        $('#pagination-page-size').val($(this).val());
        $('#form-filter').submit();
    });
    
    /**
     * Sets the delete URL for every record shown
     */
    $('.btn-delete').click(function(e){
        e.preventDefault();
        var url = $('#btn-delete').attr('data-url');
        $('#btn-delete').attr('data-url',url + $(this).attr('data-id'));
    });
    
    /**
     * Deletes on record
     */
    $('#btn-delete').click(function(e){
        e.preventDefault();
        $('#row-error').addClass('hidden');               
        var url = $('#btn-delete').attr('data-url');
        $.ajax({
            url: url,
            type: 'GET',
            data: null,
            dataType:'json',
            async: true,
            success: function(data) {
                if(data.result === "ok") {
                    $('#form-filter').submit();
                } else {
                    $('#prow-error p').text(data.mesage)
                    $('#row-error').removeClass('hidden');
                }
            },
            error: function(data) {
                $('#prow-error p').text(data.mesage);
                $('#row-error').removeClass('hidden');
                
            }
        });
    });
    
    /**
     * Deletes all selected records
     */
    $('#delete-many').click(function(e){
        e.preventDefault();
        var items = new Array();
        if($(".dynamic-checkbox:checked").length) {
            $(".dynamic-checkbox:checked").each(function(index,element){
                items.push($(this).val());
            });
        }
        
        data = {id:items};
        
        $.ajax({
            url: $(this).attr("href"),
            type: 'GET',
            data: data,
            dataType:'json',
            async: true,
            success: function(data) {
                if(data.result === "ok") {
                    $('#form-filter').submit();
                } else {
                    $('#prow-error p').text(data.mesage);
                    $('#row-error').removeClass('hidden');
                }
            },
            error: function(data) {
                $('#prow-error p').text(data.mesage);
                $('#row-error').removeClass('hidden');
            }
        });        
    });
        
    /**
     * Pagination click
     */
    $("body").on('click','.pag', function(e){
        var page = $(this).attr("data-page");
        $("#pagination-page").val(page);
        $('#form-filter').submit();
    });
    
    /**
     * Load the list
     */
    $('#form-filter').submit();            
    
});


