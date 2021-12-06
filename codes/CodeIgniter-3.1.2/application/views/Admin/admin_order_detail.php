<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand text-white" href="#">Dojo eCommerce</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="text-white mx-3" href="/users/show_admin_dashboard">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="text-white mx-3" href="/users/show_products">Products</a>
                </li>
            </ul>
        </div>
        <a class="d-flex text-white" href="/users/logoff">log off</a>
    </div>
</nav>
<div class="container mt-2">
    <div class="row">
        <div class="col ">
            <div class="border border-dark m-3 p-2">
                <p>Order ID : <?= $order_id ?></p>
                <p class="mt-3">Customer Info:</p>
                <p class="m-0">Name: <?= $client_info['name'] ?></p>
                <p class="m-0">Address : <?= $client_info['address'] ?></p>
                <p class="m-0">City: <?= $client_info['city'] ?></p>
                <p class="m-0">State: <?= $client_info['state'] ?></p>
                <p class="m-0">Zipcode: <?= $client_info['zipcode'] ?></p>
                <p class="mt-3">Customer Shipping Info:</p>
                <p class="m-0">Address : <?= $shipping_info['address'] ?></p>
                <p class="m-0">City: <?= $shipping_info['city'] ?></p>
                <p class="m-0">State: <?= $shipping_info['state'] ?></p>
                <p class="m-0">Zip: <?= $shipping_info['zipcode'] ?></p>
            </div>
        </div>
        <div class="col-9 ms-1">
            <div class="row">
                <div class="col">
                    <div class="border border-dark m-3 p-2">
                        <table class="table table-striped table-hover border">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
<?php   foreach($order_items as $item){ ?>
                                <tr>
                                    <td><?= $item['name'] ?></td>
                                    <td>$<?= $item['price'] ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>$<?= $item['price']*$item['quantity'] ?></td>
                                </tr>
<?php   } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="border border-dark m-3 p-2">
                        <p>Status: <?= $status['status'] ?></p>
                    </div>
                </div>
                <div class="col">
                    <div class="border border-dark m-3 p-2">
                        <p class="m-0">Sub-total: $<?= $total_price ?></p>
                        <p class="m-0">Shipping: $10.0</p>
                        <p class="m-0">Total Price: $<?= $total_price + 10.0 ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>