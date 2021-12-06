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
                <a class="mx-3" href="" data-toggle="modal" data-target="#update_modal"> update </a>
                <button id="delete_button" class="btn" data-toggle="modal" data-target="#delete_modal" cart_id="<?= $cart_item['order_id']?>" product_id="<?= $cart_item['product_id']?>" product_name="<?= $cart_item['name']?>"> <i class="fa fa-trash"></i> </button>
            </td>
            <td>$ <?= (int)$cart_item['price'] * (int)$cart_item['quantity'] ?></td>
        </tr>
<?php   }?>
    </tbody>
</table>