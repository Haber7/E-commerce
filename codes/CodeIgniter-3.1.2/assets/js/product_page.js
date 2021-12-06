$(document).ready(function(){
    
    /* Event for searching the name of the product */
    $(document).on("submit", "#search_form" , function(){
        $.post('/products/search_product_by_name', $(this).serialize(), function(res){
            $('.product_list').html(res);
        });
        return false;
    });

    /* Event for selecting a category of a product */
    $(document).on("click", ".category" , function(){
        $.post('/products/search_by_categories/' + $(this).text(), $(this).serialize(), function(res){
            $('.product_list').html(res);
        });
        return false;
    });

    /* Event for changing the sorting of the products */
    $(document).on("change", "form#sorter_form" , function(){
        $.post('/products/change_sort', $(this).serialize(), function(res){
            $('.product_list').html(res);
        });
        return false;
    });
    
});
