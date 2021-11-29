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
				$data = array(
					'orders' => $this->order->get_all_orders(),
					// 'num_pages' => $this->order->get_num_pages($this->order->get_all_orders())
					'num_pages' => 3,
					'current_page' => 1
				);
				
				// Shows the admin dashboard
				$this->load->view('/templates/header');
				$this->load->view('/admin/admin_dashboard', $data);
				$this->load->view('/templates/footer');
			}else{
				// Shows the Catalog
				$this->load->view('/templates/header');
				$this->load->view('/user/product');
				$this->load->view('/templates/footer');
			}
		}else{
			// Returns to the login page
			$this->session->set_flashdata('warning', 'Invalid Email or Password');
			redirect('login');
		}
	}

}