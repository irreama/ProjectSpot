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







}





?>