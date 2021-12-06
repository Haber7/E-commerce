<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Model{

    /* Function that checks the input account(email,password) if it's in the database. 
    Returns true if the account is found and return a string if not found.*/
	public function check_login_user($email,$password){
        $email = $this->security->xss_clean($email);
        $password = $this->security->xss_clean($password);
        $result = $this->db->query('SELECT * FROM users WHERE email=? AND password=?', array($email,md5($password)))->row_array();
        return $result;
    }

    /* Function to return the information about the specific user */
    public function get_user($user_id){
        return $this->db->query('SELECT * FROM users WHERE id = ?',array($user_id))->row_array();
    }

    /* Function to return the customer details using the order_id */
    public function get_user_by_order_id($order_id){
        $query = 'SELECT CONCAT(first_name," ",last_name) AS name, address, city, state, zipcode
                    FROM orders
                    LEFT JOIN users 
                        ON orders.user_id = users.id
                    LEFT JOIN addresses
                        ON users.address_id = addresses.id
                    WHERE orders.id = ?';
        $values = array($this->security->xss_clean($order_id));
        return $this->db->query($query, $values)->row_array();
    }
}