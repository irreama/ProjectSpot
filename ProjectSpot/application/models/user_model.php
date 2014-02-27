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
			'user_grad_year' => (!$this->input->post('user_grad_year')? null : $this->input->post('user_grad_year')),
			'user_gender' => $this->input->post('user_gender'),
			'user_site' => $this->input->post('user_site')
		);

		$this->db->where('id', $this->session->userdata('user_id'));
		return $this->db->update('ps_users', $data);
	}

	/**
	 * Add this new user to the database after scraping their information
	 * @param  Array $user The user's information
	 * @return Mixed The id of the user if the user was saved correctly, false if there was an issue.
	 */
	public function new_user($user){
		if($this->db->insert('ps_users', $user)){
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}

	/**
	 * Grab all of the users in the system
	 * @return array An array of users
	 */
	public function get_all_users(){
		$query = $this->db->get('ps_users');
		return $query->result_array();
	}

	public function getUserProfile($id){
		//Snag the main profile Data
		$uQuery = $this->db->get_where('ps_users', array('id' => $id));
		$user = $uQuery->row_array();

		//Snag the user's tags
		$this->db->select('ps_tags.tag_text');
		$this->db->from('ps_user_tag_rel');
		$this->db->where('user_id', $id);
		$this->db->join('ps_tags', 'ps_tags.id = ps_user_tag_rel.tag_id');
		$tQuery = $this->db->get();
		$user['tags'] = $tQuery->row_array();

		//Load up the group model
		$this->load->model("group_model");

		//Snag this user's groups
		$this->db->select('group_id');
		$this->db->from('ps_group_user_rel');
		$this->db->where('user_id', $id);
		$gQuery = $this->db->get();

		//Make the group Array
		$gArr = Array();

		//Fill it in
		foreach($gQuery->result() as $group){
			$gArr[] = $this->group_model->get_group_by_id($group->group_id);
		}

		$user['groups'] = $gArr;

		//Snag the user's majors. Major 1 is always present. major 2 is not.

		//Load up the major model
		$this->load->model("major_model");

		$major1 = $this->major_model->get_major_by_id($user['user_major1']);

		$user['user_major1'] = $major1['major_text'];

		if($user['user_major2']){
			$major2 = $this->major_model->get_major_by_id($user['user_major2']);

			$user['user_major2'] = $major2['major_text'];
		}

		return $user;
	}

	public function addAvatar($uid, $file){
		$data = array(
			'user_avatar' => $file
		);

		$this->db->where('id', $uid);
		return $this->db->update('ps_users', $data);
	}

	public function clearAvatar($uid){
		$data = array(
			'user_avatar' => ""
		);

		$this->db->where('id', $uid);
		return $this->db->update('ps_users', $data);
	}
}

?>