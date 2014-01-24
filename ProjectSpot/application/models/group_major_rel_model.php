<?php

/**
 * Group Major Relation Model
 * @author Anthony Fisher <afisher@wpi.edu>
 */
class Group_major_rel_model extends CI_Model{

	/**
	 * Constructor
	 */
	public function __construct(){
		$this->load->database();
	}

	/**
	 * Grab all of the groups that are part of a specific major
	 * @param  int 		$major_id 	The id of the major to look on
	 * @return array 	An array of all the majors
	 */
	public function get_all_groups_by_major_id($major_id){
		$query = $this->db->get_where('ps_group_major_rel', array('major_id' => $major_id));
		return $query->result_array();
	}

	/**
	 * Grab all the majors that are tied to a specific group
	 * @param  [type] $group_id 	The id of the group to look on
	 * @return [type] 				An array of all the groups
	 */
	public function get_all_majors_by_group_id($group_id){
		$query = $this->db->get_where('ps_group_major_rel', array('group_id' => $group_id));
		return $query->result_array();
	}

	/**
	 * Add a new group-major relation to the database
	 * @param  int  $group_id 	The group we want to tie to a major
	 * @param  int  $major_id 	The major we want to tie to a group
	 * @return boolean 			True on successful add, false if issues
	 */
	public function new_group_major_rel($group_id, $major_id){
		$data = array(
			'group_id' => $group_id,
			'major_id' => $major_id
		);

		$this->db->insert('ps_group_major_rel', $data);
	}

	/**
	 * Deletes the specificed relation from the database
	 * @param  int $id 	The id of the relation to delete
	 * @return boolean 	True on success, false if there was an isuse
	 */
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('ps_group_major_rel');
	}
}
?>