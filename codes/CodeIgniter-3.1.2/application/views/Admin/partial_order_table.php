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