
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="">Dojo eCommerce</a>
        <div class="d-flex">
            <a class="text-white" href="/users/show_cart">Shopping Cart (<?= $shop_cart_num ?>) </a>
            <a class="text-white px-3" href="/users/logoff">log off</a>
        </div>
    </div>
</nav>
<div class="container-fluid mt-2">
    <table id="cart_items_table" class="table table-striped table-hover border">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
<?php   foreach($cart_items as $cart_item){ ?>
            <tr>
                <td><?= $cart_item['name'] ?></td>
                <td>$<?= $cart_item['price'] ?></td>
                <td>
                    <?= $cart_item['quantity'] ?>
                    <a id="update_quantity" class="mx-3" href="" data-toggle="modal" data-target="#update_modal" quantity="<?= $cart_item['quantity'] ?>" product_id="<?= $cart_item['product_id'] ?>"> update </a>
                    <button id="delete_button" class="btn" data-toggle="modal" data-target="#delete_modal" cart_id="<?= $cart_item['order_id']?>" product_id="<?= $cart_item['product_id']?>" product_name="<?= $cart_item['name']?>"> <i class="fa fa-trash"></i> </button>
                </td>
                <td>$ <?= (int)$cart_item['price'] * (int)$cart_item['quantity'] ?></td>
            </tr>
<?php   }?>
        </tbody>
    </table>
    <div class="text-lg-right">
        <h5>Total Price: $<?= $total_price ?></h5>
        <form action="/users/show_catalog">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <button class="btn btn-success">Continue Shopping</button>
        </form>
    </div>
    <form class="mt-3 ml-3" style="width: 50%;" action="/orders/finalize_order" method="post">
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
        <input type="hidden" name="total" value="<?= $total_price ?>">
        <input type="hidden" name="order_id" value="<?= $order_id['id'] ?>">
        <h3>Shipping Information:</h3>
        <div class="row mb-3">
            <label for="address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" name="address">
            </div>
        </div>
        <div class="row mb-3">
            <label for="address_two" class="col-sm-2 col-form-label">Address 2</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address_two" name="address_two">
            </div>
        </div>
        <div class="row mb-3">
            <label for="city" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="city" name="city">
            </div>
        </div>
        <div class="row mb-3">
            <label for="state" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="state" name="state">
            </div>
        </div>
        <div class="row mb-3">
            <label for="zipcode" class="col-sm-2 col-form-label">Zip Code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="zipcode" name="zipcode">
            </div>
        </div>
        
        <!-- Card Details -->
        <h3>Payment Details:</h3>
        <div class="row mb-3">
            <label for="card" class="col-sm-2 col-form-label">Card</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="card">
            </div>
        </div>
        <div class="row mb-3">
            <label for="security_code" class="col-sm-2 col-form-label">Security Code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="security_code">
            </div>
        </div>
        <div class="row mb-3">
            <label for="expiration_date" class="col-sm-2 col-form-label">Expiration</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="expiration_date">
            </div>
        </div>
        <div class="row float-lg-right my-3">
            <input type="submit" class="btn btn-success mx-3" value="Pay">
        </div>
        
    </form>
</div>

<!-- The Update Modal -->
<div class="modal fade" id="update_modal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Quantity</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form action="/orders/update_quantity" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="row">
                        <div class="col-2">
                            <label for="quantity">Quantity</label>
                        </div>
                        <div class="col">
                            <input type="hidden" id="update_product_id" name="update_product_id" value="">
                            <input id="change_quantity" name="change_quantity" type="number" value="1" min="1" max="100">
                            <input type="submit" class="btn btn-primary mx-3" value="Update">
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
            
        </div>
    </div>
</div>

<!-- The Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Remove Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <p>Are you sure you want to remove the <span id="product_name">product</span> to the cart? </p>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer" >
                <form id="delete_item" action="/orders/remove_product_in_order" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" id="delete_product_id" name="product_id" value="">
                    <input type="hidden" id="delete_order_id" name="order_id" value="">
                    <input type="submit" class="btn btn-success" name="delete_button" value="Yes">
                </form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
            
        </div>
    </div>
</div>