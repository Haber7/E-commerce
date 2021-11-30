<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller{

    public function show_item($product_id){
        $product = $this->product->get_product_by_id($product_id);
        $data = array(
            'product' => $product,
            'images' => $this->product->get_images_by_product_id($product_id),
            'similar_items' => $this->product->get_similar_products($product['category'], $product_id)
        );
        $this->load->view('/templates/header');
        $this->load->view('/products/item', $data);
        $this->load->view('/templates/footer');
    }
}
?>