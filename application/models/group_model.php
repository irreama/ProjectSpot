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
		
	}



}



?>