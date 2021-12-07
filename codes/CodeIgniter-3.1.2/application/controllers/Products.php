<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller{

    /* Function that loads the specific item that the user clicks on the product page */
    public function show_item($product_id){
        $this->reset_search_data();
        $this->session->set_userdata('product_id', $product_id);
        $order_id = $this->order->get_cart_order_id($this->session->userdata('user_id'));

        $product = $this->product->get_product_by_id($product_id);
        $data = array(
                    'product' => $product,
                    'images' => $this->product->get_images_by_product_id($product_id),
                    'similar_items' => $this->product->get_similar_products($product['classification'], $product_id),
                    'shop_cart_num' => $this->order->get_cart_quantity($this->order->get_items_in_cart($order_id))
                );
        $this->load->view('/templates/header');
        $this->load->view('/products/item', $data);
        $this->load->view('/templates/footer');
    }

    /* Function that loads the search products of the user. The results are based on the name of the product */
    public function search_product_by_name(){
        if($this->input->post('search') == null){
            $this->session->unset_userdata('search_category');
        }

        $this->session->set_userdata('search_name', $this->input->post('search'));

        $products = $this->product->get_products_by_name($this->input->post('search'));

        $data = array(
            'products' => $this->product->view_page($this->session->userdata('current_page'), $products),
            'num_pages' => $this->product->get_num_pages($products),
        );

        $this->load->view('/partial/catalog_product_list', $data);
    }

    /* Function that loads the products based on the category clicked by the user */
    public function search_by_categories($category){
        $this->session->set_userdata('search_category', $category);
        $products = $this->product->get_products_by_category($category, $this->session->userdata('search_name'));
        $data = array(
            'products' => $this->product->view_page($this->session->userdata('current_page'), $products),
            'num_pages' => $this->product->get_num_pages($products),
        );
        $this->load->view('/partial/catalog_product_list', $data);
    }

    /* Function that loads the products based on the selected sorting method of the user */
    public function change_sort(){
        $order = $this->input->post('sorter');

        if($order == 'Most Popular'){
            $order = 'quantity_sold';
        }
        
        $products = $this->product->sort_products($this->session->userdata('search_category'), $this->session->userdata('search_name'), $order);
        $this->load->view('/partial/catalog_product_list_only', array('products' => $products));
    }

    /* Function that resets the search input in the product catalog */
    public function reset_search_data(){
        $this->session->unset_userdata('search_name');
        $this->session->unset_userdata('search_category');
    }

    /* Function that insert the products that the user bought. The function checks if the user has a cart.
    If the user has a cart it will add the item to the cart else it will create a new cart and add the item.
    After adding the item it will redirected to the product catalog */
    public function buy(){
        $order_id = $this->order->get_cart_order_id($this->session->userdata('user_id'))['id'];

        if($order_id != null){
            // Check if there are similar products in the cart
            if($this->order->get_product_in_cart($order_id, $this->session->userdata('product_id')) != null){
                $this->order->add_product_quantity($order_id, $this->session->userdata('product_id'), $this->input->post('quantity'));
            }else{
                $this->order->create_order_details($order_id, $this->session->userdata('product_id'), $this->input->post('quantity'));
            }
        }else{
            $inserted_id = $this->order->create_order($this->session->userdata('user_id'));
            $this->order->create_order_details($inserted_id, $this->session->userdata('product_id'), $this->input->post('quantity'));
        }

        redirect('/users/show_catalog');
    }
    
    /* Function to add product to the database */
    public function add_product(){
        $this->product->add_product($this->input->post(), $_FILES);
        redirect('/users/show_products');
    }

    /* Function to edit product to the database */
    public function edit_product(){
        $this->product->edit_product($this->input->post());
        redirect('/users/show_products');
    }

    /* Function to deactivate the product if the admin clicked the delete button */
    public function delete_product(){
        $product_id = $this->input->post('product_id');
        $this->product->delete_product($product_id);
        redirect('show_products');
    }

    /* Function to search a product based on the name of the product */
    public function admin_search_product(){

        $data = array(
            'products' => $this->product->view_page($this->session->userdata('current_page'), $this->product->get_products_by_name($this->input->post('search'))),
            'product_images' => $this->product->get_images(),
            'num_pages' => $this->product->get_num_pages($this->product->get_products_by_name($this->input->post('search')))
        );

        $this->load->view('/partial/admin_product_list', $data);
    }

    public function change_page($page){
		$this->session->set_userdata('current_page', $page);
        
		$data = array(
            'products' => $this->product->view_page($this->session->userdata('current_page'), $this->product->get_all_products()),
            'categories' => $this->product->get_categories(),
            'product_images' => $this->product->get_images(),
            'num_pages' => $this->product->get_num_pages($this->product->get_all_products())
        );
				
		$this->load->view('/partial/admin_product_list_only', $data);
	}
}
?>