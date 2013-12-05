<?php

/**
 * Major Model Class
 * @author Anthony Fisher <afisher@wpi.edu>
 */
class Major_model extends CI_Model{

	/**
	 * Constructor for this model.
	 */
	public function __construct(){
		//Load in the database
		$this->load->database();
	}

	/**
	 * Grab a major by its id
	 * @return Array The Major Model
	 */
	public function get_major_by_id(){

		$query = $this->db->get_where('ps_majors', array('id' => $id));
		return $query->row_array();
	}

	/**
	 * Grab all the majors in the database
	 * @return Array All of the majors
	 */
	public function get_all_majors(){
		return $this->db->get("ps_majors")->result_array();
	}

	/**
	 * Add a major into the database
	 * @param  [String] $val The name of the major we're adding to the database
	 * @return [Boolean] True if added correctly. False if there was a problem
	 */
	public function new_major($val){
		$data = array(
			'major_text' => $val;
		);

		return $this->db->insert('ps_majors', $data);
	}

	/**
	 * Change a major's text
	 * @param  [int] $id The id of the major we're changing
	 * @param  [String] $val What we want to change the major to
	 * @return [Boolean] True if changed. False if not.
	 */
	public function edit_major($id, $val){
		$data = array(
			'major_text' => $val
		);

		$this->db->where('id', $id);
		return $this->db->update('ps_majors', $data);
	}
}



?>