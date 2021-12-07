
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="">Dojo eCommerce</a>
        <div class="d-flex">
            <a class="text-white" href="/users/show_cart">Shopping Cart (<?= $shop_cart_num ?>) </a>
            <a class="text-white px-3" href="/users/logoff">log off</a>
        </div>
    </div>
</nav>

<div class="container-fluid pt-3">
    <div class="row">
        <div class="col-sm-3">
            <form id="search_form" class="search" action="/products/search_product_by_name" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="text" placeholder="Search.." name="search" value="<?= !(isset($_SESSION['search_name']))?'':$_SESSION['search_name'] ?>">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            <h4 class="mt-3">Categories</h4>
            <ul id="product_category">
<?php   foreach($categories as $category){ ?>
                <li><a class="category" href="/products/search_by_categories/<?= $category['category'] ?>"><?= $category['category'] ?></a></li>
<?php   } ?>
            </ul>
        </div>
        <div class="col border border-dark mr-3">
            <div id="product_list_and_pagination">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <h2 class="navbar-brand" href="#">Products</h2>
                        <div>
                            <form id="sorter_form" action="/products/change_sort" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <label for="sorter">Sorted by:</label>
                                <select class="px-2 mx-2" id="sorter" name="sorter">
                                    <option>Price</option>
                                    <option>Most Popular</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </nav>
                <div class="row product_list">
    <?php   foreach($products as $product){ ?>
                    <div class="col-2 p-0">
                        <div class="container-fluid">
                            <a href="/products/show_item/<?= $product['id'] ?>">
                                <div class="card bg-dark text-white">
                                    <img src="<?= base_url() ?>assets/images/products/<?= $product['image_url'] ?>" class="card-img img-thumbnail" alt="..." style="height: 100%;">
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
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
    <?php   if($num_pages > 1){ 
                for($index = 1; $index <= $num_pages; $index++){ ?>
                        <li class="page-item"><a class="page-link" href="/users/change_page/<?= $index ?>"><?= $index ?></a></li>
    <?php       }
            } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>