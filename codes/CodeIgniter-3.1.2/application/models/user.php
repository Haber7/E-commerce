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

}