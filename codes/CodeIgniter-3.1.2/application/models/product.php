<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Model{

    /* Function that returns all the category of the products */
    public function get_categories(){
        return $this->db->query('SELECT category FROM products WHERE status = "Active" GROUP BY category')->result_array();
    }

    /* Function that returns all the products */
    public function get_all_products(){
        $query = 'SELECT products.id AS id, name, description, price, image_url, inventory_count, quantity_sold, classification, category
                    FROM products 
                    LEFT JOIN product_images 
                        ON products.id = product_images.product_id
                    WHERE product_images.image_category = "Main" AND status = "Active"
                    ORDER BY price';
        return $this->db->query($query)->result_array();
    }

    /* Function that returns the number of pages. Each pages contains 36 products */
    public function get_num_pages($array){
        return ceil(COUNT($array)/36);
    }

    /* Function that returns a product using the product_id */
    public function get_product_by_id($product_id){
        $query = 'SELECT * FROM products 
                    INNER JOIN product_images 
                        ON products.id = product_images.product_id
                    WHERE product_images.image_category = "Main" AND products.id = ?';
        $values = array($this->security->xss_clean($product_id));
        return $this->db->query($query,$values)->row_array();
    }

    /* Function that returns the images of a product using product_id */
    public function get_images_by_product_id($product_id){
        $query = 'SELECT * FROM product_images WHERE product_id = ? AND image_category != "Main"';
        $values = array($this->security->xss_clean($product_id));
        return $this->db->query($query,$values)->result_array();
    }

    /* Function that gets similar products using product_id and classification */
    public function get_similar_products($classification, $product_id){
        $query = 'SELECT products.id, image_url FROM products 
                    INNER JOIN product_images 
                        ON products.id = product_images.product_id
                    WHERE products.classification = ? AND products.id != ? AND status = "Active"
                    GROUP BY products.id
                    LIMIT 8';
        $values = array(
                    $this->security->xss_clean($classification), 
                    $this->security->xss_clean($product_id)
                );
        return $this->db->query($query,$values)->result_array();
    }

    /* Function that return products that have a name like the input of the user */
    public function get_products_by_name($name){
        $query = 'SELECT products.id AS id, name, price, image_url, inventory_count, quantity_sold, classification, description
                    FROM products 
                    LEFT JOIN product_images 
                        ON products.id = product_images.product_id
                    WHERE product_images.image_category = "Main" AND name LIKE ? AND status = "Active"
                    ORDER BY price';
        $values = array('%'.$this->security->xss_clean($name).'%');
        return $this->db->query($query,$values)->result_array();
    }

    /* Function that return products that have the same category that the user clicked */
    public function get_products_by_category($category, $name){
        $query = 'SELECT products.id AS id, name, price, image_url
                    FROM products 
                    LEFT JOIN product_images 
                        ON products.id = product_images.product_id
                    WHERE product_images.image_category = "Main" AND category = ? AND name like ? AND status = "Active"
                    ORDER BY price';
        $values = array($this->security->xss_clean($category), '%'.$this->security->xss_clean($name).'%');
        return $this->db->query($query,$values)->result_array();
    }

    /* Function to sort products based on the category, name and order */
    public function sort_products($category, $name, $order){
        $query = 'SELECT products.id AS id, name, price, image_url
                    FROM products 
                    LEFT JOIN product_images 
                        ON products.id = product_images.product_id
                    WHERE product_images.image_category = "Main" AND category like ? AND name like ? AND status = "Active"
                    ORDER BY ' . $order;
        $values = array(
                    '%'.$this->security->xss_clean($category).'%', 
                    '%'.$this->security->xss_clean($name).'%',
                );
        return $this->db->query($query,$values)->result_array();
    }

    /* Function to insert a new product into the database */
    public function add_product($input_array, $file){

        if($input_array['new_category'] != null){
            $category = $input_array['new_category'];
        }else{
            $category = $input_array['category'];
        }

        $now = date('Y-m-d H:i:s');
        $data = array(
                    'name' => $this->security->xss_clean($input_array['name']),
                    'description' => $this->security->xss_clean($input_array['description']),
                    'category' => $this->security->xss_clean($category),
                    'price' => $this->security->xss_clean($input_array['price']),
                    'inventory_count' => $this->security->xss_clean($input_array['inventory_count']),
                    'status' => 'Active',
                    'quantity_sold' => $this->security->xss_clean($input_array['quantity_sold']),
                    'classification' => $this->security->xss_clean($input_array['classification']),
                    'created_at' => $now,
                    'updated_at' => $now
                );

        $this->db->insert('products', $data);

        // save file to local directory
        $this->do_upload($file);

        // Add image to the database
        $image_url = $file['image']['name'];
        $image_data = array(
                        'product_id' => $this->db->insert_id(),
                        'image_url' => $image_url,
                        'image_category' => 'Main',
                        'created_at' => $now,
                        'updated_at' => $now
                    );
        $this->db->insert('product_images', $image_data);
    }

    /* Function to save the uploaded file in the website to a local directory */
    public function do_upload($file){
        $target_dir = "./assets/images/products/";
        $target_file = $target_dir . basename($file["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($file["image"]["tmp_name"]);

            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    /* Function to edit a product in the database */
    public function edit_product($input_array){

        if($input_array['new_category'] != null){
            $category = $input_array['new_category'];
        }else{
            $category = $input_array['category'];
        }

        $now = date('Y-m-d H:i:s');
        $query = 'UPDATE products SET name = ? , description = ?, category = ?, price = ?, inventory_count = ?, quantity_sold = ?, classification = ?, updated_at = ? WHERE id = ?';
        $values = array(
                    $this->security->xss_clean($input_array['name']),
                    $this->security->xss_clean($input_array['description']),
                    $category,
                    $this->security->xss_clean($input_array['price']),
                    $this->security->xss_clean($input_array['inventory_count']),
                    $this->security->xss_clean($input_array['quantity_sold']),
                    $this->security->xss_clean($input_array['classification']),
                    $now,
                    $this->security->xss_clean($input_array['product_id'])
                );

        $this->db->query($query, $values);
    }

    /* Function to change status of the product to Inactive to deactivate the product */
    public function delete_product($product_id){
        $query = 'UPDATE products SET status = "Inactive" WHERE id = ?';
        $values = array($this->security->xss_clean($product_id));
        $this->db->query($query, $values);
    }

    /* Function to get the images from the database */
    public function get_images(){
        $query = 'SELECT name, image_url, image_category FROM products LEFT JOIN product_images ON products.id = product_images.product_id WHERE status = "Active"';
        return $this->db->query($query)->result_array();
    }

}