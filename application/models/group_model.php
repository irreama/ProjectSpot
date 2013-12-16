<?php

class Group_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function get_group_by_id($id){
		$query = $this->db->get_where('ps_groups', array('id' => $id));
		return $query->row_array();
	}

	public function new_group(){
		$this->load->helper('url');
		$this->load->model('user_model');

		$creator = $this->user_model->get_user_by_id($this->input->post('group_creator'));

		$data = array(
			'group_creator' => $this->input->post('group_creator'),
			'group_description' => $this->input->post('group_description'),
			'group_name' => $this->input->post('group_name'),
			'group_contact' => $creator['user_email']
		);

		$query = $this->db->insert('ps_groups', $data);

		return $this->db->insert_id();
	}

	public function update_group(){
		$this->load->helper('url');

		$data = array(
			'group_name' => $this->input->post('group_name'),
			'group_description' => $this->input->post('group_description'),
			'group_contact' => $this->input->post('group_contact')
		);

		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('ps_groups', $data);
	}



}



?>