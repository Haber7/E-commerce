<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Model{

    public function get_categories(){
        return $this->db->query('SELECT category FROM products GROUP BY category')->result_array();
    }

    public function get_all_products(){
        $query = 'SELECT products.id AS id, name, price, image_url
                    FROM products 
                    LEFT JOIN product_images 
                        ON products.id = product_images.product_id
                    WHERE product_images.image_category = "Main"';
        return $this->db->query($query)->result_array();
    }

    // Function that returns the number of pages. Each pages contains 36 products
    public function get_num_pages($array){
        return ceil(COUNT($array)/36);
    }

    public function get_product_by_id($product_id){
        $query = 'SELECT * FROM products 
                    INNER JOIN product_images 
                        ON products.id = product_images.product_id
                    WHERE product_images.image_category = "Main" AND products.id = ?';
        $values = array($product_id);
        return $this->db->query($query,$values)->row_array();
    }

    public function get_images_by_product_id($product_id){
        $query = 'SELECT * FROM product_images WHERE product_id = ? AND image_category != "Main"';
        $values = array($product_id);
        return $this->db->query($query,$values)->result_array();
    }

    public function get_similar_products($category, $product_id){
        $query = 'SELECT products.id, image_url FROM products 
                    INNER JOIN product_images 
                        ON products.id = product_images.product_id
                    WHERE products.category = ? AND products.id != ?
                    GROUP BY products.id
                    LIMIT 8';
        $values = array($category, $product_id);
        return $this->db->query($query,$values)->result_array();
    }

}