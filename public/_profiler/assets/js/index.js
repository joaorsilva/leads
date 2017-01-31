/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $("#collapse-filter-button").click(function(){
        if($(this).text() === 'Show') {
            $(this).text('Hide');
            $('#collapse-filter').removeClass('collapse');
        } else {
            $(this).text('Show');
            $('#collapse-filter').addClass('collapse');
        }
    });
});


