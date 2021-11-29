<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Model{

    public function get_all_orders(){
        return $this->db->query('SELECT * FROM orders')->result_array();
    }

    public function get_num_pages($array){
        return ceil(COUNT($array)/10);
    }

}