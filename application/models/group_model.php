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
		return true;
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