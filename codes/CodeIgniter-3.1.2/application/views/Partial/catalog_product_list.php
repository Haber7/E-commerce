<?php   foreach($products as $product){ ?>
    <div class="col-2 p-0">
        <div class="container-fluid">
            <a href="/products/show_item/<?= $product['id'] ?>">
                <div class="card bg-dark text-white">
                    <img src="<?= base_url() ?>assets/images/products/<?= $product['image_url'] ?>" class="card-img img-thumbnail" alt="...">
                    <div class="card-img-overlay p-0 d-flex flex-column">
                        <div class="mt-auto bg-light opacity-1">
                            <p class="mb-0 px-2 text-dark text-end">$ <?= $product['price']?></p>
                        </div>
                    </div>
                </div>
            </a>
            <p class="text-center"><?= $product['name'] ?></p>
        </div>
    </div>
<?php   } ?>