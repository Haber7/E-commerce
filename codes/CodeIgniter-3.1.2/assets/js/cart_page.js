$(document).ready(function(){

    /* Event for clicking the delete button */
    $(document).on('click','#delete_button', function(){
        $('input#delete_order_id').attr('value', $(this).attr('cart_id'));
        $('input#delete_product_id').attr('value', $(this).attr('product_id'));
        $('span#product_name').text($(this).attr('product_name'));
    })

    /* Event for clicking the update link */
    $(document).on('click','a#update_quantity', function(){
        $('input#change_quantity').attr('value', $(this).attr('quantity'));
        $('input#update_product_id').attr('value', $(this).attr('product_id'));
    });

});