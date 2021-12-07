
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
    <nav class="navbar navbar-expand-lg navbar-light p-3">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form id="search_form" class="search" action="products/admin_search_product" method="post">
                <input type="text" class="form-control" placeholder="Search Name" name="search">
            </form>
        </div>
        <div class="d-flex ">
            <button id="add_new_product_button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add new product
            </button>
        </div>
    </nav>
    <div class="container-fluid mt-2">
        <div id="product_list">
            <table id="product_list_only" class="table table-striped table-hover border">
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
                        <td hidden><?= $product['category'] ?></td>
                        <td hidden><?= $product['image_url'] ?></td>
                    </tr>
    <?php   } ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
            <?php   if($num_pages > 1){
                        for($index = 1; $index <= $num_pages; $index++){ ?>
                    <li class="page-item"><a class="page-link" href="/products/change_page/<?= $index ?>"><?= $index ?></a></li>
            <?php       } 
                    } ?>
                </ul>
            </nav>
        </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 id="createdit_modal_title" class="modal-title">Add new product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <form class="needs-validation" id="createdit_form" action="/products/add_product" method="post" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <input type="hidden" id="product_id" name="product_id" value="" />
                        <div class="row mb-3">
                            <label for="Name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">
                                    Missing Name
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" required></textarea>
                                <div class="invalid-feedback">
                                    Missing Description
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Categories</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="categories" name="category">
<?php   foreach ($categories as $category){ ?>
                                    <option><?= $category['category'] ?></option>
<?php   } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="new_category" class="col-sm-2 col-form-label">Add new category</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="new_category" name="new_category" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inventory_count" name="price" required>
                                <div class="invalid-feedback">
                                    Missing Price
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inventory_count" class="col-sm-2 col-form-label">Inventory Count</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inventory_count" name="inventory_count" required >
                                <div class="invalid-feedback">
                                    Missing Inventory Count
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity_sold" class="col-sm-2 col-form-label">Quantity Sold</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="quantity_sold" name="quantity_sold" required >
                                <div class="invalid-feedback">
                                    Missing Quantity Sold
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="classification" class="col-sm-2 col-form-label">Classification</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="classification" name="classification" required >
                                <div class="invalid-feedback">
                                    Missing Classification
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="new_category" class="col-sm-2 col-form-label">Images</label>
                            <div class="col-sm-10">
                                <input type="file" class="btn btn-light" value="Upload" accept="image/*" name="image" size="20" required >
                            </div>
                        </div>

                    <!-- Images View -->
                        <div class="row mb-3">
                            <div class="col-sm-2 col-form-label"></div>
                            <div class="col-sm-10 mx-auto">
                                <img id="product_image" src="" height="50px">
                            </div>
                        </div>  
                    </form>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button id="cancel_button" type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <input id="edit_add_button" type="submit" class="btn btn-primary" form="createdit_form" value="Add">
                </div>
                
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <p>Are you sure you want to delete the product</p>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <form action="/products/delete_product" method="post">
                        <input id="delete_product_id" type="hidden" name="product_id" value="">
                        <input type="submit" class="btn btn-success" value="Yes">
                    </form>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">No</button>
                </div>
                
            </div>
        </div>
    </div>