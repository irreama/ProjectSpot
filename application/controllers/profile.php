<?php

/**
 * User Profile Controller Class
 * @author Anthony Fisher <afisher@wpi.edu>
 */
class Profile extends CI_Controller {

	/**
	 * Constructor for the Profile Controller
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('user_tag_rel_model');
	}

	/**
	 * Generate the View Profile Page
	 * Accessed from /profile/view/$id
	 * @param  int $id The id of the user we're looking at
	 */
	public function view($id){
		//Generate the data used in the view
		$data['profile_item'] = $this->user_model->get_user_by_id($id);
		$data['profile_item']['ps_tags'] = $this->user_tag_rel_model->get_all_tags_by_user_id($id);
		$data['title'] = 'User Profile';

		//Load our views
		$this->load->view('templates/header', $data);
		$this->load->view('profile/view', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Generate the Edit Profile Page
	 * Accessed from /profile/edit/$id
	 * Also handles form submission
	 * @param  int $id The id of the user we're editing
	 */
	public function edit($id){
		//Load our helpers
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		//Generate the data used in the views
		$data['profile_item'] = $this->user_model->get_user_by_id($id);
		$data['profile_item']['ps_tags'] = $this->user_tag_rel_model->get_all_tags_by_user_id($id);
		$data['title'] = 'Edit Profile';

		//Require ID to save the form
		$this->form_validation->set_rules('id', 'id', 'required');

		//Check if the form is valid.
		if($this->form_validation->run() == FALSE){

			//If the form is not validated, display the form again.
			$this->load->view('templates/header', $data);
			$this->load->view('profile/edit', $data);
			$this->load->view('templates/footer');
		}
		else{
			//Save the user
			$this->user_model->save_user();

			//Head back to the user view pages
			redirect('profile/view/'.$id);
		}

	}
}

?>