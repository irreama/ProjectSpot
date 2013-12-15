<?php


class Tag_rels extends CI_Controller {

	/**
	 * Constructor for the Profile Controller
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('user_tag_rel_model');
		$this->load->model('tag_model');
	}

	/**
	 * Load the view for editing user interests
	 * @param  int $id The id of the user to edit interests
	 */
	public function edit_user($id){
		//Load our helpers
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$data['title'] = "Edit Interests";

		//Grab the tags this user already has
		$data['tag_item']['item_id'] = $id;
		$data['tag_item']['user_tags'] = $this->user_tag_rel_model->get_all_tags_by_user_id($id);
		$data['tag_item']['tags'] = $this->tag_model->get_all_tags();

		$this->form_validation->set_rules('id', 'id', 'required');

		if($this->form_validation->run() == FALSE){
		//Load our views
			$this->load->view('templates/header', $data);
			$this->load->view('tag_rels/edit', $data);
			$this->load->view('templates/footer');
		}
		else{
			//Save the relations
			$this->user_tag_rel_model->delete_user_tags($id);
			$this->user_tag_rel_model->add_tags_to_user();

			//Head back to the user edit pages
			redirect('profile/edit/'.$id);
		}
	}
}

?>