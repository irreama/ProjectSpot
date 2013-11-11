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

	public function edit($id){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['profile_item'] = $this->user_model->get_user_by_id($id);
		$data['title'] = 'Edit Profile';

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('profile/edit', $data);
			$this->load->view('templates/footer');
		}
		else{
			$this->user_model->save_user();
			view($id);
		}

	}
}

?>