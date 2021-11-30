<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Model{

    public function get_all_orders(){
        return $this->db->query('SELECT * FROM orders')->result_array();
    }

    // Function that returns the number of pages. Each pages contains 10 orders
    public function get_num_pages($array){
        return ceil(COUNT($array)/10);
    }

    public function get_cart_orders($user_id){
        $query = 'SELECT * FROM orders WHERE user_id = ?';
        $values = array($user_id);
        $this->db->query($query, $values)->result_array();
    }
}