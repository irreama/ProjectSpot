<?php

/**
 * User Tag Relation Model
 */
class User_tag_rel_model extends CI_Model{

	/**
	 * Constructor
	 */
	public function __construct(){
		$this->load->database();
	}

	/**
	 * Grab all of the users tied to a specific tag
	 * @param  int $tag_id 	The id of the tag we want to search on
	 * @return array 		An array of user ids
	 */
	public function get_all_users_by_tag_id($tag_id){
		$query = $this->db->get_where('ps_user_tag_rel', array('tag_id' => $tag_id));
		return $query->result_array();
	}

	/**
	 * Grab all of the tags associated with a specific user
	 * @param  int $user_id 	The id of the user we want to search on
	 * @return array 			An array of tags and tag ids
	 */
	public function get_all_tags_by_user_id($user_id){
		$this->db->from("ps_user_tag_rel");
		$this->db->where('user_id', $user_id);
		$this->db->join('ps_tags', 'ps_user_tag_rel.tag_id = ps_tags.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Add a new user, tag relation to the database
	 * @param  int $user_id 	The user we want to tie to a tag
	 * @param  int $tag_id 		The tag we want to tie to a user
	 * @return boolean 			True on success, false on failure
	 */
	public function new_user_tag_rel($user_id, $tag_id){
		$data = array(
			'user_id' => $user_id,
			'tag_id' => $tag_id
		);

		$this->db->insert('ps_user_tag_rel', $data);
	}

	/**
	 * Delete a specific user, tag relation from the database
	 * @param  int $id 		The relation to delete
	 * @return boolean 		True on success, false on failure
	 */
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('ps_user_tag_rel');
	}
}
?>