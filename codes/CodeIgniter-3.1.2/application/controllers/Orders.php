<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends CI_Controller{

    /* Function that removes the specific item in the cart */
    public function remove_product_in_order(){
        $this->order->remove_order_item($this->input->post('order_id'), $this->input->post('product_id'));
        redirect('show_cart');
    }

    /* Function to insert the order payment and the shipping address into database */
    public function finalize_order(){
        $shipping_address_inserted_id = $this->order->create_shipping_address($this->input->post());
        $total = $this->input->post('total');
        $payment_inserted_id = $this->order->create_payment($shipping_address_inserted_id, $total);

        $this->order->insert_payment($payment_inserted_id, $this->input->post('order_id'));
        redirect('show_user');
    }

    /* Function to change the quantity of a product in the cart */
    public function update_quantity(){
        $product_id = $this->input->post('update_product_id');
        $new_quantity = $this->input->post('change_quantity');
        $order_id = $this->order->get_cart_order_id($this->session->userdata('user_id'));

        $this->order->change_product_quantity($order_id, $product_id, $new_quantity);
        redirect('show_cart');
    }

    /* Function to sort status of the orders from the list of orders in the admin module */
    public function sort_status(){
        if($this->input->post('status') == 'Show All'){
            $status = '%%';
        }else{
            $status = $this->input->post('status');
        }

        $data = array(
                    'orders' => $this->order->get_orders_by_status($status),
                    'totals' => $this->order->get_totals($this->order->get_orders_by_status($status)),
                    'num_pages' => $this->order->get_num_pages($this->order->get_orders_by_status($status)),
                    'array_choices' => ['Order in process', 'Shipped', 'Cancelled']
                );

        $this->load->view('/partial/admin_order_list', $data);
    }

    /* Function to search the name or the order id of the list of orders */
    public function search_name_id(){
        if(is_numeric($this->input->post('search_order'))){
            $id = $this->input->post('search_order');
            $data = array(
                        'orders' => $this->order->view_page($this->session->userdata('current_page'), $this->order->get_orders_by_id($id)),
                        'totals' => $this->order->get_totals($this->order->get_orders_by_id($id)),
                        'num_pages' => $this->order->get_num_pages($this->order->get_orders_by_id($id)),
                        'array_choices' => ['Order in process', 'Shipped', 'Cancelled']
                    );
        }else{
            $name = $this->input->post('search_order');
            $data = array(
                        'orders' => $this->order->view_page($this->session->userdata('current_page'), $this->order->get_orders_by_name($name)),
                        'totals' => $this->order->get_totals($this->order->get_orders_by_name($name)),
                        'num_pages' => $this->order->get_num_pages($this->order->get_orders_by_name($name)),
                        'array_choices' => ['Order in process', 'Shipped', 'Cancelled']
                    );
        }

        $this->load->view('/partial/admin_order_list', $data);
        
    }

    /* Function to change the status of the order in the admin module */
    public function change_status(){
        $status = $this->input->post('status');
        $order_id = $this->input->post('id');
        $this->order->change_order_status($order_id, $status);
        $data = array(
            'orders' => $this->order->get_all_orders(),
            'totals' => $this->order->get_totals($this->order->get_all_orders()),
            'num_pages' => $this->order->get_num_pages($this->order->get_all_orders()),
            'array_choices' => ['Order in process', 'Shipped', 'Cancelled']
        );
        $this->load->view('/partial/admin_order_list', $data);
    }

    public function change_page($page){
		$this->session->set_userdata('current_page', $page);

        $data = array(
            'orders' => $this->order->view_page($this->session->userdata('current_page'), $this->order->get_all_orders()),
            'totals' => $this->order->get_totals($this->order->get_all_orders()),
            'num_pages' => $this->order->get_num_pages($this->order->get_all_orders()),
            'current_page' => $this->session->userdata('current_page'),
            'array_choices' => ['Order in process', 'Shipped', 'Cancelled']
        );

        $this->load->view('/partial/admin_order_list_only', $data);
	}

}
?>