<?php

/**
 * User Model Class
 * @author Anthony Fisher <afisher@wpi.edu>
 * @version  1.0
 * @since November 5, 2013
 */
class User_model extends CI_Model{

	/**
	 * Constructor for the User_model class.
	 */
	public function __construct(){
		$this->load->database();
	}

	/**
	 * Grab a user by their id in the database
	 * @param  int $id The id of the user in the database
	 * @return array The row in the database as an array. It is empty on failure
	 */
	public function get_user_by_id($id){
		$query = $this->db->get_where('ps_users', array('id' => $id));
		return $query->row_array();
	}

	/**
	 * Grab a user by their login in the database
	 * @param  string $user_login The login of the user
	 * @return array The row in the database as an array. Empty on failure
	 */
	public function get_user_by_user_login($user_login){
		$query = $this->db->get_where('ps_users', array('user_login' => $user_login));
		return $query->row_array();
	}

}

?>