<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand text-white" href="#">Dojo eCommerce</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="text-white mx-3" href="admin_dashboard">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="text-white mx-3" href="admin_show_products.html">Products</a>
                </li>
            </ul>
        </div>
        <a class="d-flex text-white" href="admin_login_page.html">log off</a>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light p-3">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="search" action="#">
            <input type="text" class="form-control" placeholder="Search">
        </form>
    </div>
    <div class="d-flex ">
        <form action="">
            <select>
                <option>Show All</option>
                <option>Shipped</option>
                <option>Order in Progress</option>
                <option>Cancelled</option>
                <option>Pending</option>
            </select>
        </form>
    </div>
</nav>
<!-- Table of Orders -->
<div class="container-fluid mt-2">
    <table class="table table-striped table-hover border">
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
<?php foreach($orders as $order){ ?>
            <tr>
                <td><a href="admin_order_detail.html">100</a></td>
                <td>Bob</td>
                <td>9/6/2014</td>
                <td>Billing Address, Billing Address</td>
                <td>19.99</td>
                <td>
                    <form action="">
                        <select>
                            <option>Order in Progress</option>
                            <option>Shipped</option>
                            <option>Cancelled</option>
                        </select>
                    </form>
                </td>
            </tr>
<?php } ?>  
        </tbody>
    </table>
</div>
<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
<?php   if($num_pages > 2){ ?>
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