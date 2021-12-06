$(document).ready(function() {
    
    // Event to change the modal to Add New Product if the add new product button is clicked
    $(document).on('click','#add_new_product_button', function(){
        $('#createdit_form').attr('action', '/products/add_product');
        $('#createdit_modal_title').text('Add New Product');
        $('#preview_button').remove();
        $('#edit_add_button').attr('value', 'Add');
    });

    // Event to change and pass data to the modal if the edit link is clicked
    $(document).on('click','#edit_product_link', function(){
        $('#createdit_form').attr('action', '/products/edit_product');
        $('#createdit_modal_title').text('Edit Product');
        $('#product_id').attr('value', $(this).parent().parent().children(':nth-child(2)').text());
        $('input#name').attr('value', $(this).parent().parent().children(':nth-child(3)').text());
        $('textarea#description').text($(this).parent().parent().children(':nth-child(7)').text());
        $('input#price').attr('value', $(this).parent().parent().children(':nth-child(8)').text());
        $('input#inventory_count').attr('value', $(this).parent().parent().children(':nth-child(4)').text());
        $('input#quantity_sold').attr('value', $(this).parent().parent().children(':nth-child(5)').text());
        $('input#classification').attr('value', $(this).parent().parent().children(':nth-child(9)').text());
        $('select#categories').children().attr("selected", false);
        let category = $(this).parent().parent().children(':nth-child(10)').text();
        $('select#categories option:contains("'+category+'")').attr("selected", true);
        $('#product_image').attr('src', window.location.origin + "/assets/images/products/" + $(this).parent().parent().children(':nth-child(11)').text());
        if($('#preview_button').length == 0){
            $('#cancel_button').after('<button id="preview_button" type="button" class="btn btn-success" data-dismiss="modal">Preview</button>');
        }
        $('#edit_add_button').attr('value', 'Edit');
    });

    // Event that change and pass the product id variable to the modal if the delete link is clicked
    $(document).on('click','#delete_product_link', function(){
        $('#delete_product_id').attr('value', $(this).parent().parent().children(':nth-child(2)').text());
    })

    // Event to change the product list if there is a user input on the search field
    $(document).on('keyup', '#search_form', function(){
        $.post('/products/admin_search_product', $(this).serialize(), function(res){
            $('#product_list').html(res);
        });
        return false;
    })
})