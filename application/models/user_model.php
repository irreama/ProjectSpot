<?php

/**
 * User Model Class
 * @author Anthony Fisher <afisher@wpi.edu>
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

	/**
	 * Save the user to the database
	 * @return True if the user has been saved. False if there was a problem
	 */
	public function save_user(){
		$this->load->helper('url');

		$data = array(
			'user_description' => $this->input->post('user_description'),
			'user_gender' => $this->input->post('user_gender')
		);

		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('ps_users', $data);
	}

	/**
	 * Add this new user to the database after scraping their information
	 * @param  String $login The user's login information
	 * @return Boolean True if the user was saved correctly, false if there was an issue.
	 */
	public function new_user($login){
		return true;
	}

	public function get_all_users(){
		$query = $this->db->get('ps_users');
		return $query->result_array();
	}

}

?>