<?php

class Group extends CI_Controller{

	public function __construct(){
		parent::__construct();
		checkSession();
		$this->load->model('group_model');
		$this->load->model('group_user_rel_model');
		$this->load->model('group_tag_rel_model');
		$this->load->model('major_model');

		$data['displayName'] = $this->session->userdata('display_name');
	}

		public function clearAvatar(){
		$this->load->helper('file');
		$uid = $this->session->userdata('user_id');
		$gid = $this->input->post('gid');

		//check to see if the user is a member
		if($this->group_user_rel_model->isUserInGroup($uid, $gid)){
			$this->group_model->clearAvatar($gid);

			//delete_files('./images/avatars/'.$uid);
			
			echo "Deleted";
		}
	}

	public function uploadAvatar(){
		$uid = $this->session->userdata('user_id');
		$gid = $this->input->post('gid');

				//check to see if the user is a member
		if($this->group_user_rel_model->isUserInGroup($uid, $gid)){
			if(!is_dir('./images/avatars/groups/'.$gid)){
				mkdir('./images/avatars/groups/'.$gid);
			}

			$config['upload_path'] = './images/avatars/groups/'.$gid;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '300';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['file_name'] = $gid;
			$config['overwrite'] = true;

			$this->load->library('upload', $config);
			$returnCodes = array();

			if ( ! $this->upload->do_upload()){
				$returnCodes['success'] = false;
				$returnCodes['errors'] = $this->upload->display_errors();
				$returnCodes['gid'] = $gid;
			}
			else{
				$avatarData = $this->upload->data();

				$avatarPath = 'images/avatars/groups/'.$gid.'/'.$avatarData['file_name'];
				$this->group_model->addAvatar($gid, $avatarPath);

				$returnCodes['success'] = true;
				$returnCodes['filePath'] = $avatarPath;
				
			}

			echo json_encode($returnCodes);
		}

		
	}

	public function acceptInvite(){
		$this->load->model("user_model");

		$sender = $this->session->userdata('user_id');
		$id = $this->input->post('id');

		$invite = $this->group_user_rel_model->get($id);

		$senderModel = $this->user_model->get_user_by_id($sender);

		//check if the user can accept this invite
		if($invite['user_id'] == $sender && (!$this->group_user_rel_model->isUserInAnyGroup($sender) || $senderModel['user_status'] == "Advisor")){
			$this->group_user_rel_model->update($id, "accepted");
			echo json_encode(true);
		}
		else{
			echo json_encode(false);
		}

	}

	public function rejectInvite(){
		$sender = $this->session->userdata('user_id');
		$id = $this->input->post('id');

		$invite = $this->group_user_rel_model->get($id);

		//print_r($invite);

		//check if the user can reject this invite
		if($invite['user_id'] == $sender || $this->group_user_rel_model->isUserInGroup($sender, $invite['group_id'])){
			$this->group_user_rel_model->delete($id);
			echo json_encode(true);
		}
		else{
			echo json_encode(false);
		}
	}

	public function requestToInvite(){
		$this->load->model("user_model");

		$sender = $this->session->userdata('user_id');
		$gid = $this->input->post('gid');
		$uid = $this->input->post('uid');

		$recipient = $this->user_model->get_user_by_id($uid);

		if((!$this->group_user_rel_model->isUserInAnyGroup($uid) || $recipient['user_status'] == "Advisor") && $this->group_user_rel_model->canUserRequestToJoin($uid, $gid)){
			$this->group_user_rel_model->new_group_user_rel($gid, $uid, $sender, 'Requested');
		}
	}

	public function invite(){
		$this->load->model("user_model");

		$sender = $this->session->userdata('user_id');
		$gid = $this->input->post('gid');
		$uid = $this->input->post('uid');

		$recipient = $this->user_model->get_user_by_id($uid);

		if((!$this->group_user_rel_model->isUserInAnyGroup($uid) || $recipient['user_status'] == "Advisor") && $this->group_user_rel_model->canUserRequestToJoin($uid, $gid)){
			$this->group_user_rel_model->new_group_user_rel($gid, $uid, $sender, 'invited');
		}
	}

	public function landing(){
		$uid = $this->session->userdata('user_id');

		//Load the user Model
		$this->load->model("user_model");

		//check to see if the user is in a group
		//Fix this for live
		$data['group_item'] = $this->group_user_rel_model->get_all_groups_by_user_id($uid);
		$user = $this->user_model->get_user_by_id($uid);


		if(empty($data['group_item'])){
			$data['title'] = "Groups";
			$this->load->view('templates/header', $data);
			$this->load->view('group/landing', $data);
			$this->load->view('templates/footer');
		}
		else if($user['user_status'] != "Advisor"){
			$this->load->helper('url');
			redirect('group/view/'.$data['group_item'][0]['id']);
		}
		else{
			$data['title'] = "Groups";
			$this->load->view('templates/header', $data);
			$this->load->view('group/advisorLanding', $data);
			$this->load->view('templates/footer');
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

		$uid = $this->session->userdata('user_id');

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

			$this->group_user_rel_model->new_group_user_rel($new_id, $uid, null, 'Accepted');


			//Head to the group view page
			redirect('group/view/'.$new_id);
		}
	}
}





?>