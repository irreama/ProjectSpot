<?php

/**
 * Tag Model Class
 * @author Anthony Fisher <[afisher@wpi.edu]>
 */
class Tag_model extends CI_Model{

	/**
	 * Constructor for the Tag model
	 */
	public function __construct(){
		$this->load->database();
	}

	/**
	 * Grab all the tags in the Database
	 * @return Array A tag of all the arrays
	 */
	public function get_all_tags(){
		$this->db->order_by("tag_text", "asc"); 
		$query = $this->db->get("ps_tags");
		return $query->result_array();
	}

	/**
	 * Get a tag by its id
	 * @param  [int] $id The id of the tag
	 * @return [array] The tag itself. Empty on failure.
	 */
	public function get_tag_by_id($id){
		$query = $this->db->get_where('ps_tags', array('id' => $id));
		return $query->result_array();
	}

	/**
	 * Edit a tag's value
	 * @param  [int] $id The id of the tag we're editing
	 * @param  [String] $val The new value of the tag
	 * @return [boolean] True if successful. False if not.
	 */
	public function edit_tag($id, $val){
		$data = array(
			'tag_text' => $val
		);

		$this->db->where('id', $id);
		return $this->db->insert('ps_tags', $data);
	}

	/**
	 * Add a tag to the database
	 * @param  [String] $val The text of the tag we're adding
	 * @return [boolean] True if successful, false if not.
	 */
	public function new_tag($val){
		$data = array(
			'tag_text' => $val
		);

		return $this->db->insert('ps_tags', $data);
	}
}



?>