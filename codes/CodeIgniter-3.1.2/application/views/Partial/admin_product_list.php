<table id="product_list" class="table table-striped table-hover border">
    <thead>
        <tr>
            <th>Picture</th>
            <th>ID</th>
            <th>Name</th>
            <th>Inventory Count</th>
            <th>Quantity Sold</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php   foreach($products as $product){ ?>
        <tr>
            <td><img src="<?= base_url() ?>assets/images/products/<?= $product['image_url'] ?>" height="50px"></td>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['inventory_count'] ?></td>
            <td><?= $product['quantity_sold'] ?></td>
            <td>
                <a id="edit_product_link" class="mx-2" href="#" data-toggle="modal" data-target="#myModal">Edit</a>
                <a id="delete_product_link" href="#" data-toggle="modal" data-target="#delete_modal">Delete</a>
            </td>
            <td hidden><?= $product['description'] ?></td>
            <td hidden><?= $product['price'] ?></td>
            <td hidden><?= $product['classification'] ?></td>
        </tr>
<?php   } ?>
    </tbody>
</table>