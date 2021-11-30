<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="">Dojo eCommerce</a>
        <div class="d-flex">
            <a class="text-white" href="/users/show_cart">Shopping Cart (5)</a>
            <a class="text-white px-3" href="">log off</a>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <a class="ml-3" href="/users/show_catalog">Go Back</a>
    <h3 class="ml-3">Product Name</h3>
    <div class="container-fluid pt-3">
        <div class="row">
            <!-- Product Image -->
            <div class="col-sm-3 p-3 border">
                <img src="<?= base_url() ?>/assets/images/products/<?= $product['image_url'] ?>" class="img-thumbnail" alt="...">
                <!-- Product other images -->
                <ul class="list-group list-group-horizontal mt-3">
<?php   foreach($images as $image){ ?>
                    <li class="list-group-item p-1 border border-white" style="height: 100px; width: 100px;">
                        <a href="">
                            <img src="<?= base_url() ?>/assets/images/products/<?= $image['image_url'] ?>" class="h-100 w-100 img-thumbnail" alt="product other picture">
                        </a>
                    </li>
<?php   } ?>
                </ul>
            </div>
            <div class="col border mx-3 p-2">
                <p><?= $product['description'] ?></p>
                <p>Qui occaecat ut laboris eiusmod aute culpa fugiat eiusmod nulla quis enim. Minim cillum exercitation velit dolore cupidatat eiusmod ea reprehenderit occaecat laborum. Aute duis Lorem cupidatat do tempor eiusmod. Culpa deserunt veniam in aliquip quis cupidatat culpa consectetur. Ullamco consequat adipisicing ullamco mollit Lorem do nisi sit et.</p>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid my-2">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand">Similar Items</a>
                        <form class="d-flex" action="">
                            <select class="form-select">
<?php   for($count = 1; $count <= 3; $count++){ ?>
                                <option><?= $count . ' $' . $product['price']*$count ?></option>
<?php   } ?>
                            </select>
                            <input class="mx-2" type="submit" value="Buy">
                        </form>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <ul class="list-group list-group-horizontal">
<?php   foreach($similar_items as $similar_item){ ?>
                <li class="list-group-item p-1 border border-white" style="height: 100px; width: 100px;">
                    <a href="/products/show_item/<?= $similar_item['id'] ?>">
                        <img src="<?= base_url() ?>/assets/images/products/<?= $similar_item['image_url'] ?>" class="h-100 w-100 img-thumbnail" alt="...">
                    </a>
                </li>
<?php   } ?>
            </ul>
        </div>
    </div>
</div>