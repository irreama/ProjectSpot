<?php

class Profile extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function view($id){
		$data['profile_item'] = $this->user_model->get_user_by_id($id);
		$data['title'] = 'User Profile';

		$this->load->view('templates/header', $data);
		$this->load->view('profile/view', $data);
		$this->load->view('templates/footer');
	}
}

?>