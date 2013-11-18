<?php

class Group extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('group_model');
	}

	public function view($id){
		$data['group_item'] = $this->group_model->get_group_by_id($id);
		$data['title'] = "Group Profile";

		$this->load->view('templates/header', $data);
		$this->load->view('group/view', $data);
		$this->load->view('templates/footer');
	}

	public function new(){
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$data['title'] = "New Group";

		$this->form_validation->set_rules('group_creator', 'group_creator', 'required');
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');

		if($this->form_validation->run() == FALSE){

			//If the form is not validated, display the form again.
			$this->load->view('templates/header', $data);
			$this->load->view('group/new');
			$this->load->view('templates/footer');
		}
		else{
			//Save the user
			$new_id = $this->group_model->new_group();

			//Head back to the user view pages
			redirect('group/view/'.$new_id);
		}
	}







}





?>