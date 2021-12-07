$(document).ready(function(){

    // Event in changing the sorting of the order list
    $(document).on('change', '#sort_status_form', function(){
        $.post('/orders/sort_status', $(this).serialize(), function(res){
            $('#order_table').html(res);
        });
        return false;
    });

    // Event in searching the name or the id of the order
    $(document).on('keyup', '#search_form', function(){
        $.post('/orders/search_name_id', $(this).serialize(), function(res){
            $('#order_table').html(res);
        });
        return false;
    });

    // Event in changing the status of the order
    $(document).on('change', '#change_status_form', function(){
        $.post('/orders/change_status', $(this).serialize(), function(res){
            $('#order_table').html(res);
        });
        return false;
    });

    // Event in changing the page
    $(document).on("click", "a.page-link" , function(){
        $.post('/orders/change_page/' + $(this).text(), $(this).serialize(), function(res){
            $('#order_list').html(res);
        });
        return false;
    });
    
});

