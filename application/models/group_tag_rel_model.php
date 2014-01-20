<?php

/**
 * Group Tag Relation Model
 * @author Anthony Fisher <afisher@wpi.edu>
 */
class Group_tag_rel_model extends CI_Model{

	/**
	 * Constructor
	 */
	public function __construct(){
		$this->load->database();
	}

	/**
	 * Grab all the groups tied to a specific tag
	 * @param  int $tag_id 		The tag to search for
	 * @return array 			An array of group IDs
	 */
	public function get_all_groups_by_tag_id($tag_id){
		$query = $this->db->get_where('ps_group_tag_rel', array('tag_id' => $tag_id));
		return $query->result_array();
	}

	/**
	 * Grab all of the tags tied to a specific group
	 * @param  int $group_id 	The group we want to search on
	 * @return array 			An array of tag ids
	 */
	public function get_all_tags_by_group_id($group_id){
		$this->db->from("ps_group_tag_rel");
		$this->db->where('group_id', $group_id);
		$this->db->join('ps_tags', 'ps_group_tag_rel.tag_id = ps_tags.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Add a new group, tag relation to the database
	 * @param  int $group_id 	The group we want to tie to a tag
	 * @param  int $tag_id 		The tag we want to tie to a group
	 * @return boolean			True on success, False on failure
	 */
	public function new_group_tag_rel($group_id, $tag_id){
		$data = array(
			'group_id' => $group_id,
			'tag_id' => $tag_id
		);

		$this->db->insert('ps_group_tag_rel', $data);
	}

	/**
	 * Add the given tags to the group
	 */
	public function add_tags_to_group(){
		$this->load->helper('url');

		$tags = $this->input->post('tags');
		$group_id = $this->input->post('id');
		foreach($tags as $tag_id){
			$data = array(
			'group_id' => $group_id,
			'tag_id' => $tag_id
			);

			$this->db->insert('ps_group_tag_rel', $data);
		}
	}

	/**
	 * Delete a specific group, tag relation from the database
	 * @return boolean 	True on success, False on failure
	 */
	public function delete(){
		$this->db->where('id', $id);
		$this->db->delete('ps_group_tag_rel');
	}

	/**
	 * Delete all of a group's tag relations
	 * @param  int $group_id The group's id that we're removing the relations of
	 * @return boolean          True on success, False on failure
	 */
	public function delete_group_tags($group_id){
		$this->db->where('group_id', $group_id);
		$this->db->delete('ps_group_tag_rel');
	}
}
?>