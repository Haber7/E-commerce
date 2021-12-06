<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller{

	/* Function that shows the login page to the user and checks if there are user that are logged in.
	If the user is logged in, it will redirect to the admin dashboard or the product catalog */
	public function index(){
		$user_id = $this->session->userdata('user_id');

		if( isset($user_id) ){
			$this->check_user_level($user_id);	
		}else{
			$this->load->view('/templates/header');
			$this->load->view('/users/login_page');
			$this->load->view('/templates/footer');
		}
		
	}

	/* Function that checks the input account if valid or not */
	public function check_account(){
		$result = $this->user->check_login_user($this->input->post('email'), $this->input->post('password'));

		if($result != null){
			$this->session->set_userdata('user_id', $result['id']);
			$this->check_user_level($result['id']);
		}else{
			$this->session->set_flashdata('warning', 'Invalid Email or Password');
			redirect('login');
		}
	}

	/* Function that checks the account if it is admin or a user */
	public function check_user_level($user_id){
		$user = $this->user->get_user($user_id);
		if($user['is_admin'] == 1){
			redirect('show_admin');
		}else{
			redirect('show_user');
		}
	}

	/* Function that loads the view admin dashboard */
	public function show_admin_dashboard(){
		$data = array(
					'orders' => $this->order->get_all_orders(),
					'totals' => $this->order->get_totals($this->order->get_all_orders()),
					'num_pages' => $this->order->get_num_pages($this->order->get_all_orders()),
					'current_page' => 1,
					'array_choices' => ['Order in process', 'Shipped', 'Cancelled']
				);
		$this->load->view('/templates/admin_dashboard_header');
		$this->load->view('/admin/admin_dashboard', $data);
		$this->load->view('/templates/footer');
	}

	/* Function that loads the view catalog */
	public function show_catalog(){
		$order_id = $this->order->get_cart_order_id($this->session->userdata('user_id'));

		$data = array(
					'categories' => $this->product->get_categories(),
					'products' => $this->product->get_all_products(),
					// 'num_pages' => $this->product->get_num_pages($this->product->get_all_products()),
					'num_pages' => 4,
					'shop_cart_num' => $this->order->get_cart_quantity($this->order->get_items_in_cart($order_id))
				);

		$this->load->view('/templates/product_page_header');
		$this->load->view('/users/product_page', $data);
		$this->load->view('/templates/footer');
	}

	/* Function that shows the cart of the user */
	public function show_cart(){
		$order_id = $this->order->get_cart_order_id($this->session->userdata('user_id'));

		$data = array(
					'cart_items' => $this->order->get_items_in_cart($order_id),
					'total_price' => $this->order->get_total_price($this->order->get_items_in_cart($order_id)),
					'order_id' => $order_id,
					'shop_cart_num' => $this->order->get_cart_quantity($this->order->get_items_in_cart($order_id))
				);

		$this->load->view('/templates/cart_page_header');
		$this->load->view('/users/cart_page', $data);
		$this->load->view('/templates/footer');
	}

	/* Function to display the details of an order when clicked by the admin */
	public function show_order_details($order_id){
		$data = array(
					'order_id' => $order_id,
					'client_info' => $this->user->get_user_by_order_id($order_id),
					'shipping_info' => $this->order->get_shipping_address($order_id),
					'order_items' => $this->order->get_order_items($order_id),
					'status' => $this->order->get_status($order_id),
					'total_price' => $this->order->get_total_price($this->order->get_order_items($order_id))
				);
				
		$this->load->view('/templates/header');
		$this->load->view('/admin/admin_order_detail', $data);
		$this->load->view('/templates/footer');
	}

	/* Function to display the products to the admin */
	public function show_products(){
		$data = array(
					'products' => $this->product->get_all_products(),
					'categories' => $this->product->get_categories(),
					'product_images' => $this->product->get_images()
				);
		$this->load->view('/templates/view_products_header');
		$this->load->view('/admin/admin_show_products', $data);
		$this->load->view('/templates/footer');
	}

	/* Function that logoff the user and redirects to the login page */
	public function logoff(){
		$this->session->sess_destroy();
		redirect('login');
	}

}