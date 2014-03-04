<?php

class Group extends CI_Controller{

	public function __construct(){
		parent::__construct();
		checkSession();
		$this->load->model('group_model');
		$this->load->model('group_user_rel_model');
		$this->load->model('group_tag_rel_model');
		$this->load->model('group_major_rel_model');
		$this->load->model('major_model');

		$data['displayName'] = $this->session->userdata('display_name');
	}

	public function holdForInterests(){
		$formData = array('groupFormData');

		$formData['groupFormData']['group_name'] = $this->input->post('group_name');
		$formData['groupFormData']['group_description'] = $this->input->post('group_description');
		$formData['groupFormData']['group_needs'] = $this->input->post('group_needs');
		$formData['groupFormData']['group_site'] = $this->input->post('group_site');
		$formData['groupFormData']['group_contact'] = $this->input->post('group_contact');

		$this->session->set_userdata($formData);

	}

	public function removeGroup(){
		$gid = $this->input->post("gid");

		//Check to see if this person is in the group
		if($this->group_user_rel_model->isUserInGroup($this->session->userdata('user_id'), $gid)){
			//Check to see if this really is the last member in the group
			if(count($this->group_user_rel_model->get_all_users_by_group_id($gid)) == 1){
				//Remove the user from the group
				$this->group_user_rel_model->removeUserFromGroup($this->session->userdata('user_id'), $gid);

				//Remove the majors from the group
				$this->group_major_rel_model->removeMajorsFromGroup($gid);

				//Remove the tags from the group
				$this->group_tag_rel_model->delete_group_tags($gid);
				
				//Remove the group itself
				$this->group_model->delete($gid);
			}
		}

	}

	public function isLastMember(){
		$uid = $this->input->post("uid");
		$gid = $this->input->post("gid");

		//Check to see if there aren't more members in this group
		if(count($this->group_user_rel_model->get_all_users_by_group_id($gid)) == 1){
			echo "true";
		}
		else{
			echo "false";
		}
	}

	public function removeMember(){
		$uid = $this->input->post("uid");
		$gid = $this->input->post("gid");

		//Check to see if this member is in the group
		if($this->group_user_rel_model->isUserInGroup($this->session->userdata('user_id'), $gid)){
			//Remove the member
			$this->group_user_rel_model->removeUserFromGroup($uid, $gid);
			echo "true";
		}
		else{
			echo "false";
		}
		
		
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
			$config['max_size']	= '3072';
			$config['max_width']  = '2000';
			$config['max_height']  = '2000';
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

	public function rejectRequest(){
		$this->load->model("user_model");

		$sender = $this->session->userdata('user_id');
		$id = $this->input->post('id');

		$invite = $this->group_user_rel_model->get($id);

		$requesterModel = $this->user_model->get_user_by_id($invite['user_id']);

		if($this->group_user_rel_model->isUserInGroup($sender, $invite['group_id'])){
			$this->group_user_rel_model->delete($id);
			echo json_encode(true);
		}
		else{
			echo json_encode(false);
		}
	}

	public function acceptRequest(){
		$this->load->model("user_model");

		$sender = $this->session->userdata('user_id');
		$id = $this->input->post('id');

		$invite = $this->group_user_rel_model->get($id);

		$requesterModel = $this->user_model->get_user_by_id($invite['user_id']);

		if($this->group_user_rel_model->isUserInGroup($sender, $invite['group_id']) && (!$this->group_user_rel_model->isUserInAnyGroup($invite['user_id']) || $requesterModel['user_status'] == "Advisor")){
			$this->group_user_rel_model->update($id, "accepted");
			echo json_encode(true);
		}
		else{
			echo json_encode(false);
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
		if($this->group_user_rel_model->isUserInGroup($this->session->userdata('user_id'), $id)){
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

			//Check to see if we stored data
			if($this->session->userdata('groupFormData')){
				$formData = $this->session->userdata('groupFormData');

				$data['group_item']['group_name'] = $formData['group_name'];
				$data['group_item']['group_description'] = $formData['group_description'];
				$data['group_item']['group_needs'] = $formData['group_needs'];
				$data['group_item']['group_site'] = $formData['group_site'];
				$data['group_item']['group_contact'] = $formData['group_contact'];


				$this->session->unset_userdata('groupFormData');
			}

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
		else{
			redirect('group/view/'.$id);
		}
		
	}

	public function create(){
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('user_model');

		$uid = $this->session->userdata('user_id');

		$currUser = $this->user_model->get_user_by_id($uid);

		$data['contact'] = $currUser['user_email'];

		if(!$this->group_user_rel_model->isUserInAnyGroup($uid) || $currUser['user_status'] == "Advisor"){
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
		else{
			redirect('group');
		}
	}
}





?>