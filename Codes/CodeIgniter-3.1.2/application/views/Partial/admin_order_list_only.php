
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