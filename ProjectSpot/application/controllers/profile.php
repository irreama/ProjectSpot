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

		//Check if we're logged in
		checkSession();
		$this->load->model('user_model');
		$this->load->model('major_model');
		$this->load->model('user_tag_rel_model');
		$this->load->model('group_user_rel_model');
	}

	public function holdForInterests(){
		$formData = array('profileFormData');

		$formData['profileFormData']['user_gender'] = $this->input->post('user_gender');
		$formData['profileFormData']['user_description'] = $this->input->post('user_description');
		$formData['profileFormData']['user_grad_year'] = $this->input->post('user_grad_year');

		$this->session->set_userdata($formData);

	}

	public function clearAvatar(){
		$this->load->helper('file');
		$uid = $this->session->userdata('user_id');

		$this->user_model->clearAvatar($uid);

		//delete_files('./images/avatars/'.$uid);
		
		echo "Deleted";
	}

	public function uploadAvatar(){
		$uid = $this->session->userdata('user_id');
		if(!is_dir('./images/avatars/profiles/'.$uid)){
			mkdir('./images/avatars/profiles/'.$uid);
		}

		$config['upload_path'] = './images/avatars/profiles/'.$uid;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '3072';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['file_name'] = $uid;
		$config['overwrite'] = true;

		$this->load->library('upload', $config);
		$returnCodes = array();

		if ( ! $this->upload->do_upload()){
			$returnCodes['success'] = false;
			$returnCodes['errors'] = $this->upload->display_errors();
		}
		else{
			$avatarData = $this->upload->data();

			$avatarPath = 'images/avatars/profiles/'.$uid.'/'.$avatarData['file_name'];
			$this->user_model->addAvatar($uid, $avatarPath);

			$returnCodes['success'] = true;
			$returnCodes['filePath'] = $avatarPath;
			
		}

		echo json_encode($returnCodes);
	}

	/**
	 * Generate the View Profile Page
	 * Accessed from /profile/view/$id
	 * @param  int $id The id of the user we're looking at
	 */
	public function view($id){
		//Generate the data used in the view
		$data['profile_item'] = $this->user_model->get_user_by_id($id);
		$data['profile_item']['user_major1'] = $this->major_model->get_major_by_id($data['profile_item']['user_major1']);
		if(!is_null($data['profile_item']['user_major2'])){
			$data['profile_item']['user_major2'] = $this->major_model->get_major_by_id($data['profile_item']['user_major2']);
		}
		else{
			$data['profile_item']['user_major2']['major_text'] = "";
		}
		
		$data['profile_item']['ps_tags'] = $this->user_tag_rel_model->get_all_tags_by_user_id($id);
		$data['profile_item']['ps_groups'] = $this->group_user_rel_model->get_all_groups_by_user_id($id);
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
	public function edit($errors=""){
		//Load our helpers
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$id = $this->session->userdata('user_id');

		//Generate the data used in the views
		$data['profile_item'] = $this->user_model->get_user_by_id($id);
		$data['profile_item']['user_major1'] = $this->major_model->get_major_by_id($data['profile_item']['user_major1']);
		if(!is_null($data['profile_item']['user_major2'])){
			$data['profile_item']['user_major2'] = $this->major_model->get_major_by_id($data['profile_item']['user_major2']);
		}
		else{
			$data['profile_item']['user_major2']['major_text'] = "";
		}
		$data['profile_item']['ps_tags'] = $this->user_tag_rel_model->get_all_tags_by_user_id($id);
		$data['title'] = 'Edit Profile';

		//Check to see if we stored data
		if($this->session->userdata('profileFormData')){
			$formData = $this->session->userdata('profileFormData');

			$data['profile_item']['user_grad_year'] = $formData['user_grad_year'];
			$data['profile_item']['user_description'] = $formData['user_description'];
			$data['profile_item']['user_gender'] = $formData['user_gender'];

			$this->session->unset_userdata('profileFormData');
		}

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