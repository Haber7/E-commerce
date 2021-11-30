<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller{

	/* Function that shows the login page to the user */
	public function index(){
		$this->load->view('/templates/header');
		$this->load->view('/users/login_page');
		$this->load->view('/templates/footer');
	}

	/* Function that redirects to the admin_dashboard or product_page based on the 
	userlevel and if the account if found. Returns to login page if the account is not found */
	public function check_account(){
		$result = $this->user->check_login_user($this->input->post('email'), $this->input->post('password'));

		if($result != null){
			$this->session->set_userdata('user_id', $result['id']);
			if($result['is_admin'] == 1){
				$this->show_admin_dashboard();
			}else{
				$this->show_catalog();
			}
		}else{
			// Returns to the login page
			$this->session->set_flashdata('warning', 'Invalid Email or Password');
			redirect('login');
		}
	}

	/* Function that loads the view admin dashboard */
	public function show_admin_dashboard(){
		$data = array(
			'orders' => $this->order->get_all_orders(),
			'num_pages' => $this->order->get_num_pages($this->order->get_all_orders()),
			'current_page' => 1
		);

		$this->load->view('/templates/header');
		$this->load->view('/admin/admin_dashboard', $data);
		$this->load->view('/templates/footer');
	}

	/* Function that loads the view catalog */
	public function show_catalog(){
		$data = array(
			'categories' => $this->product->get_categories(),
			'products' => $this->product->get_all_products(),
			'num_pages' => $this->product->get_num_pages($this->product->get_all_products())
		);

		// Shows the Catalog
		$this->load->view('/templates/header');
		$this->load->view('/users/product_page', $data);
		$this->load->view('/templates/footer');
	}

	public function show_cart(){
		$data = array(
			'cart_orders' => $this->order->get_cart_orders($this->session->userdata('user_id')),
			'user' => $this->user->get_user($this->session->userdata('user_id'))
		);
		var_dump($data);
		$this->load->view('/templates/header');
		$this->load->view('/users/cart_page', $data);
		$this->load->view('/templates/footer');
	}

}