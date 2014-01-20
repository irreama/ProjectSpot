<?php

class Group extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('group_model');
		$this->load->model('group_user_rel_model');
		$this->load->model('group_tag_rel_model');
		$this->load->model('major_model');
	}

	public function landing(){
		//check to see if the user is in a group
		//Fix this for live
		$data['group_item'] = $this->group_user_rel_model->get_all_groups_by_user_id(4);

		if(empty($data['group_item'])){
			$data['title'] = "Groups";
			$this->load->view('templates/header', $data);
			$this->load->view('group/landing', $data);
			$this->load->view('templates/footer');
		}
		else{
			$this->load->helper('url');
			redirect('group/view/'.$data['group_item'][0]['id']);
		}
		
		
	}

	public function view($id){
		$data['group_item'] = $this->group_model->get_group_by_id($id);
		$users = $this->group_user_rel_model->get_all_users_by_group_id($id);
		foreach($users as $user){
			$user['user_major1'] = $this->major_model->get_major_by_id($user['user_major1']);
			$data['group_item']['users'][] = $user;
		}
		 
		$data['group_item']['tags'] = $this->group_tag_rel_model->get_all_tags_by_group_id($id);

		$data['title'] = "Group Profile";

		$this->load->view('templates/header', $data);
		$this->load->view('group/view', $data);
		$this->load->view('templates/footer');
	}

	public function edit($id){
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$data['group_item'] = $this->group_model->get_group_by_id($id);
		$users = $this->group_user_rel_model->get_all_users_by_group_id($id);
		foreach($users as $user){
			$user['user_major1'] = $this->major_model->get_major_by_id($user['user_major1']);
			$data['group_item']['users'][] = $user;
		}
		 
		$data['group_item']['tags'] = $this->group_tag_rel_model->get_all_tags_by_group_id($id);

		$data['title'] = "Edit Group";

		$this->form_validation->set_rules('group_name', 'Group Name', 'required');

		if($this->form_validation->run() == FALSE){

			//If the form is not validated, display the form again.
			$this->load->view('templates/header', $data);
			$this->load->view('group/edit', $data);
			$this->load->view('templates/footer');
		}
		else{
			//Save the user
			$this->group_model->update_group();

			//Head back to the user view pages
			redirect('group/view/'.$id);
		}
	}

	public function create(){
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
			//Save the group
			$new_id = $this->group_model->new_group();

			$this->group_user_rel_model->new_group_user_rel($new_id, $this->input->post('group_creator'), 'Accepted');


			//Head to the group view page
			redirect('group/view/'.$new_id);
		}
	}







}





?>