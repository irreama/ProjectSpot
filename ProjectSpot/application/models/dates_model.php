<?php
class Dates_model extends CI_Model{

	/**
	 * Constructor for this model.
	 */
	public function __construct(){
		//Load in the database
		$this->load->database();
	}

	public function getDate($id){
		$query = $this->db->get_where('ps_dates', array('id' => $id));
		return $query->row_array();
	}

	public function getAllDates(){
		$query = $this->db->get('ps_dates');
		return $query->result_array();
	}

	public function getUpcomingDates(){
		$this->db->from('ps_dates');
		$this->db->where('date_timestamp >', 'NOW()');
		$this->db->order_by('date_timestamp', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>