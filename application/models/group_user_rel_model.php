<?php

/**
 * Group User Relation Model Class
 */
class Group_user_rel_model extends CI_Model{

	/**
	 * Constructor
	 */
	public function __construct(){
		$this->load->database();
	}

	/**
	 * Grab all the users tied to a specific group
	 * @param  [int] $group_id 	[The group id to search on]
	 * @return [array] 			[An array of all the users in this group]
	 */
	public function get_all_users_by_group_id($group_id){
		$this->db->from('ps_group_user_rel');
		$this->db->where('group_id', $group_id);
		$this->db->join('ps_groups', 'ps_groups.id = ps_group_user_rel.group_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Grab all of the groups tied to a specific user
	 * @param  [int] $user_id 	[the user to search on]
	 * @return [array]          [An array of all the group ids]
	 */
	public function get_all_groups_by_user_id($user_id){
		$query = $this->db->get_where('ps_group_user_rel', array('user_id' => $user_id));
		return $query->result_array();
	}

	/**
	 * Insert a new relation into the database
	 * @param  [int] $group_id  		[The id of the group we're relating]
	 * @param  [int] $user_id  			[The id of the user we're relating]
	 * @param  [String] $status   		[The invitation status of the user. ENUM in the Database. Accepted values are 'Invited', 'Confirmation Needed', 'Accepted']
	 * @return [boolean]           		[True if successful. False if not.]
	 */	
	public function new_group_user_rel($group_id, $user_id, $status){
		$data = array(
			'group_id' => $group_id,
			'user_id' => $user_id,
			'invite_status' => $status
		);

		$this->db->insert('ps_group_user_rel', $data);
	}

	/**
	 * Update the relations invitation status
	 * @param  [int] $id      	[The id of the relation we're updating]
	 * @param  [int] $status 	[The new invitation status]
	 * @return [boolean]        [True on success. False on failure]
	 */
	public function update($id, $status){
		$data = array(
			'invite_status' => $status
		);

		$this->db->where('id', $id);
		$this->db->update('ps_group_user_rel', $data);
	}

	/**
	 * Delete a relation from the database
	 * @param  [int] $id  	[The id of the rel to delete]
	 * @return [boolean]    [true if successful, false if not]
	 */
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('ps_group_user_rel');
	}
}
?>