<?php

class Group_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	/**
	 * Snag a simple group profile
	 * @param  int $id The id of the group
	 * @return array     the simple group array
	 */
	public function get_group_by_id($id){
		$query = $this->db->get_where('ps_groups', array('id' => $id));
		return $query->row_array();
	}

	/**
	 * Add a new group
	 * @return int the id of the group we added
	 */
	public function new_group(){
		$this->load->helper('url');

		$data = array(
			'group_creator' => $this->input->post('group_creator'),
			'group_description' => $this->input->post('group_description'),
			'group_name' => $this->input->post('group_name'),
			'group_contact' => $this->input->post('group_contact')
		);

		$query = $this->db->insert('ps_groups', $data);

		return $this->db->insert_id();
	}

	/**
	 * Update a group
	 */
	public function update_group(){
		$this->load->helper('url');

		$data = array(
			'group_name' => $this->input->post('group_name'),
			'group_description' => $this->input->post('group_description'),
			'group_contact' => $this->input->post('group_contact')
		);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('ps_groups', $data);
	}

	/**
	 * Snag the group profile in a human readable format, with extras added
	 * @param  int $id The id of the group we want to get
	 * @return array     the group array
	 */
	public function getGroupProfile($id){
		//Snag the main group profile
		$gQuery = $this->db->get_where('ps_groups', array('id' => $id));
		$group = $gQuery->row_array();

		//Snag the group's tags
		$this->db->select('ps_tags.tag_text');
		$this->db->from('ps_group_tag_rel');
		$this->db->where('group_id', $id);
		$this->db->join('ps_tags', 'ps_tags.id = ps_group_tag_rel.tag_id');
		$tQuery = $this->db->get();
		$group['tags'] = $tQuery->row_array();

		//Snag the group's majors
		$this->db->select('ps_majors.major_text');
		$this->db->from('ps_group_major_rel');
		$this->db->where('group_id', $id);
		$this->db->join('ps_majors', 'ps_majors.id = ps_group_major_rel.major_id');
		$mQuery = $this->db->get();
		$group['majors'] = $mQuery->row_array();

		//Load up the user model
		$this->load->model('user_model');

		//Snag the group's users
		$this->db->select('user_id');
		$this->db->from('ps_group_user_rel');
		$this->db->where('group_id', $id);
		$uQuery = $this->db->get();

		//Make the user Array
		$uArr = Array();

		//Fill it in
		foreach($uQuery->result() as $user){
			$uArr[] = $this->user_model->get_user_by_id($user->user_id);
		}

		$group['users'] = $uArr;

		$group['group_creator'] = $this->user_model->get_user_by_id($group['group_creator']);

		return $group;
	}


}



?>