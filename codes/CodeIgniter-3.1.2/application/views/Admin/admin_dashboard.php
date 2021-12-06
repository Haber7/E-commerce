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
        <a class="text-white px-3" href="/users/logoff">log off</a>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light p-3">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form id="search_form" class="search" action="/orders/search_name_id">
            <input name="search_order" type="text" class="form-control" placeholder="Search">
        </form>
    </div>
    <div class="d-flex ">
        <form id="sort_status_form" action="/orders/sort_status" method="post">
            <select name="status">
                <option>Show All</option>
                <option>Shipped</option>
                <option>Order in process</option>
                <option>Cancelled</option>
                <option>Cart</option>
            </select>
        </form>
    </div>
</nav>
<!-- Table of Orders -->
<div id="order_table" class="container-fluid mt-2">
    <table id="order_list" class="table table-striped table-hover border">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Billing Address</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
<?php   foreach($orders as $key => $order){ ?>
            <tr>
                <td><a href="/users/show_order_details/<?= $order['id'] ?>"><?= $order['id'] ?></a></td>
                <td><?= $order['name'] ?></td>
                <td><?= $order['date'] ?></td>
                <td><?= $order['address'] ?></td>
                <td>$<?= $totals[$key]+10 ?></td>
                <td>
                    <form id="change_status_form" action="/orders/change_status" method="post">
                        <input type="hidden" name="id" value="<?= $order['id'] ?>" />
                        <select id="status" name="status">
                            <option class="status_selected" selected="selected"> <?= $order['status'] ?> </option> 
<?php       foreach($array_choices as $choices){ 
                if($order['status'] != $choices){ ?>
                            <option> <?= $choices ?> </option>
<?php           }
            } ?>
                        </select>
                    </form>
                </td>
            </tr>
<?php   } ?>  
        </tbody>
    </table>
</div>

<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
<?php   if($num_pages > 1){ ?>
        <li class="page-item disabled">
            <a class="page-link">Previous</a>
        </li>
<?php       for($index = 1; $index <= $num_pages; $index++){ ?>
        <li class="page-item"><a class="page-link" href="#"><?= $index ?></a></li>
<?php       } ?>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
<?php   } ?>
    </ul>
</nav>