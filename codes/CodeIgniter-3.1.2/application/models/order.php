<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Model{

    /* Function that returns all the orders */
    public function get_all_orders(){
        $query = 'SELECT orders.id, 
                        CONCAT(users.first_name," ", users.last_name) AS name, 
                        DATE(orders.created_at) AS date, 
                        orders.status,
                        CONCAT(addresses.address, " , ", addresses.city) AS address
                    FROM orders 
                    LEFT JOIN users 
                        ON orders.user_id = users.id
                    LEFT JOIN addresses 
                        ON users.address_id = addresses.id';
        return $this->db->query($query)->result_array();
    }

    /* Function that returns the number of pages. Each pages contains 10 orders */
    public function get_num_pages($array){
        return ceil( COUNT($array)/10 );
    }

    /* function that gets all orders of a specific user */
    public function get_all_orders_from_user($user_id){
        $query = 'SELECT * FROM orders WHERE user_id = ?';
        $values = array($user_id);
        $this->db->query($query, $values)->result_array();
    }

    /* Function to return the cart of a specific user */
    public function get_cart_order_id($user_id){
        $query = 'SELECT id FROM orders WHERE user_id = ? AND status = "Cart"';
        $values = array($user_id);
        return $this->db->query($query, $values)->row_array();
    }

    /* Function to create a cart of a specific user */
    public function create_order($user_id){
        $now = date('Y-m-d H:i:s');
        $data = array(
                    'user_id' => $this->security->xss_clean($user_id),
                    'status' => 'Cart',
                    'created_at' => $now,
                    'updated_at' => $now
                );
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    /* Function to add items which a user bought */
    public function create_order_details($order_id, $product_id, $quantity){
        $now = date('Y-m-d H:i:s');
        $data = array(
                    'order_id' => $this->security->xss_clean($order_id), 
                    'product_id' => $this->security->xss_clean($product_id), 
                    'quantity' => $this->security->xss_clean($quantity), 
                    'created_at' => $now, 
                    'updated_at' => $now
                );
        $this->db->insert('order_details', $data);
    }

    /* Function that adds a quantity of a product if the product is already in the cart */
    public function add_product_quantity($order_id, $product_id, $quantity){
        $old_quantity = $this->get_quantity($order_id, $product_id);
        $query = 'UPDATE order_details SET quantity = ? WHERE order_id = ? and product_id = ?';
        $values = array(($old_quantity + (int)substr($quantity, 0, 1)), $order_id, $product_id);
        $this->db->query($query, $values);
    }

    /* Function that returns the quantity of a specific product and specific order */
    public function get_quantity($order_id, $product_id){
        $query = 'SELECT quantity FROM order_details WHERE order_id = ? AND product_id = ?';
        $values = array($order_id, $product_id);
        $quantity = $this->db->query($query, $values)->row_array()['quantity'];
        if($quantity == null){
            return 0;
        }
        return $quantity;
    }

    /* Function that returns a specific product in a specific cart */
    public function get_product_in_cart($order_id, $product_id){
        $query = 'SELECT * FROM order_details WHERE order_id = ? AND product_id = ?';
        $values = array($order_id, $product_id);
        return $this->db->query($query, $values)->result_array();
    }

    /* Function that returns array of products given the order_id from the order_details */
    public function get_items_in_cart($order_id){
        $query = 'SELECT * FROM order_details 
                    LEFT JOIN products
                        ON order_details.product_id = products.id
                    WHERE order_id = ?';
        $values = array($order_id);
        return $this->db->query($query, $values)->result_array();
    }

    /* Function that returns the total price of the given array of products */
    public function get_total_price($array){
        $total_price = 0;
        foreach($array as $items){
            $price = (int)$items['price'];
            $quantity = (int)$items['quantity'];
            $total_price += $price * $quantity; 
        }
        return $total_price;
    }

    /* Function to remove a product in the cart of the customer */
    public function remove_order_item($order_id, $product_id){
        $query = 'DELETE FROM order_details WHERE order_id = ? AND product_id = ?';
        $values = array(
                        $this->security->xss_clean($order_id),
                        $this->security->xss_clean($product_id)
                    );
        $this->db->query($query, $values);
    }

    /* Function to change the quantity of a product in a cart */
    public function change_product_quantity($order_id, $product_id, $new_quantity){
        $query = 'UPDATE order_details SET quantity = ? WHERE order_id = ? AND product_id = ?';
        $values = array(
                        $this->security->xss_clean($new_quantity),
                        $this->security->xss_clean($order_id),
                        $this->security->xss_clean($product_id)
                    );
        $this->db->query($query, $values);
    }

    /* Function to insert the shipping address into the database */
    public function create_shipping_address($input_array){
        $now = date('Y-m-d H:i:s');
        $data = array(
                    'address' => $this->security->xss_clean($input_array['address']),
                    'address2' => $this->security->xss_clean($input_array['address_two']),
                    'city' => $this->security->xss_clean($input_array['city']),
                    'state' => $this->security->xss_clean($input_array['state']),
                    'zipcode' => $this->security->xss_clean($input_array['zipcode']),
                    'created_at' => $now,
                    'updated_at' => $now
                );
        $this->db->insert('shipping_addresses', $data);
        return $this->db->insert_id();
    }

    /* Function to create a payment of the cart and insert into the database */
    public function create_payment($shipping_address_id, $total){
        $now = date('Y-m-d H:i:s');
        $data = array(
                    'shipping_address_id' => $this->security->xss_clean($shipping_address_id),
                    'amount' => $this->security->xss_clean($total),
                    'created_at' => $now,
                    'updated_at' => $now
                );
        $this->db->insert('payments', $data);
        return $this->db->insert_id();
    }

    /* Function to insert the payment to the order table in the database */
    public function insert_payment($id, $order_id){
        $query = 'UPDATE orders SET payment_id = ? WHERE id = ?';
        $values = array($this->security->xss_clean($id), $this->security->xss_clean($order_id));
        $this->db->query($query,$values);
        $this->change_status($order_id);
    }

    /* Function to change the status of the order */
    private function change_status($order_id){
        $query = 'UPDATE orders SET status = "Order in process" WHERE id = ?';
        $values = array($this->security->xss_clean($order_id));
        $this->db->query($query, $values);
    }

    /* Function to return all the items in a specific order using order_id */
    public function get_order_items($order_id){
        $query = 'SELECT * FROM order_details 
                    LEFT JOIN products 
                        ON order_details.product_id = products.id
                    WHERE order_id = ?';
        $values = array($this->security->xss_clean($order_id));
        return $this->db->query($query, $values)->result_array();
    }

    /* Function to return the shipping address of an order */
    public function get_shipping_address($order_id){
        $query = 'SELECT address, city, state, zipcode FROM orders
                    LEFT JOIN payments
                        ON orders.payment_id = payments.id
                    LEFT JOIN shipping_addresses
                        ON payments.shipping_address_id = shipping_addresses.id
                    WHERE orders.id = ?';
        $values = array($this->security->xss_clean($order_id));
        return $this->db->query($query, $values)->row_array();
    }

    /* Function to get the status of an order */
    public function get_status($order_id){
        $query = 'SELECT status FROM orders WHERE id = ?';
        $values = array($this->security->xss_clean($order_id));
        return $this->db->query($query, $values)->row_array();
    }

    /* Function to get the number of items in a cart using array of products */
    public function get_cart_quantity($cart_array){
        $total_quantity = 0;
        foreach($cart_array as $cart_item){
            $total_quantity += $cart_item['quantity'];
        }
        return $total_quantity;
    }

    /* Function to get the total amount to be paid of an order */
    public function get_totals($orders){
        $total_array = array();
        foreach($orders as $order){
            $order_items = $this->get_items_in_cart($order['id']);
            $total = $this->get_total_price($order_items);
            $total_array[] = $total;
        }
        return $total_array;
    }

    /* Function to return a sorted list of orders order by status */
    public function get_orders_by_status($status){
        $query = 'SELECT orders.id, 
                        CONCAT(users.first_name," ", users.last_name) AS name, 
                        DATE(orders.created_at) AS date, 
                        orders.status,
                        CONCAT(addresses.address, " , ", addresses.city) AS address
                    FROM orders 
                    LEFT JOIN users 
                        ON orders.user_id = users.id
                    LEFT JOIN addresses 
                        ON users.address_id = addresses.id
                    WHERE status like ?';
        $values = array($this->security->xss_clean($status));
        return $this->db->query($query, $values)->result_array();
    }

    /* Function to return a list of orders using the name of the customer */
    public function get_orders_by_name($name){
        $query = 'SELECT orders.id, 
                        CONCAT(users.first_name," ", users.last_name) AS name, 
                        DATE(orders.created_at) AS date, 
                        orders.status,
                        CONCAT(addresses.address, " , ", addresses.city) AS address
                    FROM orders 
                    LEFT JOIN users 
                        ON orders.user_id = users.id
                    LEFT JOIN addresses 
                        ON users.address_id = addresses.id
                    WHERE CONCAT(users.first_name," ", users.last_name) like ?';
        $values = array('%'.$this->security->xss_clean($name).'%');
        return $this->db->query($query, $values)->result_array();
    }

    /* Function to return the order using the order id */
    public function get_orders_by_id($id){
        $query = 'SELECT orders.id, 
                        CONCAT(users.first_name," ", users.last_name) AS name, 
                        DATE(orders.created_at) AS date, 
                        orders.status,
                        CONCAT(addresses.address, " , ", addresses.city) AS address
                    FROM orders 
                    LEFT JOIN users 
                        ON orders.user_id = users.id
                    LEFT JOIN addresses 
                        ON users.address_id = addresses.id
                    WHERE orders.id like ?';
        $values = array('%'.$this->security->xss_clean($id).'%');
        return $this->db->query($query, $values)->result_array();
    }

    /* Function to change the status of specific order */
    public function change_order_status($order_id, $status){
        $query = 'UPDATE orders SET status = ? WHERE id = ?';
        $values = array($this->security->xss_clean($status), $this->security->xss_clean($order_id));
        $this->db->query($query, $values);
    }

    public function view_page($current_page, $order_array){
        $new_array = array();
        $num_per_page = 10;
        $start = ($current_page*$num_per_page) - $num_per_page;
        if(($current_page*$num_per_page) < count($order_array)){
            $end = ($current_page*$num_per_page);
        }else{
            $end = count($order_array);
        }
        for($count = $start; $count < $end; $count++){
            $new_array[] = $order_array[$count];
        }
        return $new_array;
    }
}