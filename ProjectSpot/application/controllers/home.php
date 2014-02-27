<?php
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		checkSession();
		$this->load->model('user_model');
		$this->load->model('group_model');
	}

	public function index(){

		$data['title'] = 'Dashboard';
		$uid = $this->session->userdata('user_id');

		$this->load->model('user_tag_rel_model');
		$this->load->model('group_user_rel_model');
		$this->load->model('group_tag_rel_model');

		$data['messages']['user'] = array();
		$data['messages']['group'] = array();

		$user = $this->user_model->get_user_by_id($uid);

		//Load up user specific messages
		
		//Check if we have tags
		if(count($this->user_tag_rel_model->get_all_tags_by_user_id(4)) == 0){
			$data['messages']['user'][] = array(
				'text' => "Add your interests to your profile",
				'linkText' => "Add interests now",
				'link' => "profile/interests/edit"
			);
		}

		if(!$user['user_grad_year']){
			$data['messages']['user'][] = array(
				'text' => "Select your graduation year in your profile",
				'linkText' => "Add a graduation year now",
				'link' => "profile/edit"
			);
		}

		//Check if we have a description
		if(is_null($user['user_description']) || $user['user_description'] == ""){
			$data['messages']['user'][] = array(
				'text' => "Add a description of you to your profile",
				'linkText' => "Add a description now",
				'link' => "profile/edit"
			);
		}

		//Check if we have an avatar
		if(is_null($user['user_avatar']) || $user['user_avatar'] == ""){
			$data['messages']['user'][] = array(
				'text' => "Add a picture to your profile",
				'linkText' => "Upload an image now",
				'link' => "profile/edit"
			);
		}

		if(count($this->group_user_rel_model->getIncomingInvitesByUserId($uid)) > 0){
			$data['messages']['user'][] = array(
				'text' => "You have a pending invite to join a group",
				'linkText' => "Check invites now",
				'link' => "invites"
			);
		}

		//Check to see if the user is in a group
		if(!$this->group_user_rel_model->isUserInAnyGroup($uid)){
			$data['messages']['user'][] = array(
				'text' => "Find or Create an MQP Group",
				'linkText' => "Find or Create an MQP Group",
				'link' => "group"
			);
		}

		else{
			//Fill in messages for groups

			//Grab the group id
			$userGroups = $this->group_user_rel_model->get_all_groups_by_user_id($uid);

			foreach($userGroups as $group){
				$group = $this->group_model->get_group_by_id($group['id']);
				$data['messages']['group'][$group['id']]['name'] = $group['group_name'];
				$data['messages']['group'][$group['id']]['messages'] = array();

				$data['messages']['group'][$group['id']]['messages'][] = array(
					'text' => "Add members to your MQP Group",
					'linkText' => "Browse students now",
					'link' => "browse"
				);

				$data['messages']['group'][$group['id']]['messages'][] = array(
					'text' => "Add advisors to your MQP Group",
					'linkText' => "Browse advisors now",
					'link' => "browse"
				);

				if(count($this->group_tag_rel_model->get_all_tags_by_group_id($group['id'])) == 0){
					$data['messages']['group'][$group['id']]['messages'][] = array(
						'text' => "Add interests to your group profile (what topics your project is on)",
						'linkText' => "Add interests now",
						'link' => "group/interests/edit/".$group['id']
					);
				}

				if(is_null($group['group_description']) || $group['group_description'] == ""){
					$data['messages']['group'][$group['id']]['messages'][] = array(
						'text' => "Add a description to your group profile",
						'linkText' => "Add a description now",
						'link' => "group/edit/".$group['id']
					);
				}

				if(is_null($group['group_needs']) || $group['group_needs'] == ""){
					$data['messages']['group'][$group['id']]['messages'][] = array(
						'text' => "Add a description to your group profile of what members your group still needs",
						'linkText' => "Add a Members Needed description now",
						'link' => "group/edit/".$group['id']
					);
				}

				if(is_null($group['group_avatar']) || $group['group_avatar'] == ""){
					$data['messages']['group'][$group['id']]['messages'][] = array(
						'text' => "Add a picture to your group profile",
						'linkText' => "Upload an image now",
						'link' => "group/edit/".$group['id']
					);
				}

				if(is_null($group['group_site']) || $group['group_site'] == ""){
					$data['messages']['group'][$group['id']]['messages'][] = array(
						'text' => "Add your personal website to your profile",
						'linkText' => "Add your website now",
						'link' => "group/edit/".$group['id']
					);
				}

				if(count($this->group_user_rel_model->getSentInvitesByGroupId($group['id']))){
					$data['messages']['group'][$group['id']]['messages'][] = array(
						'text' => "Your groupmate has invited someone to your group",
						'linkText' => "Check invites now",
						'link' => "invites"
					);
				}
			}
		}



		//Load our views
		$this->load->view('templates/header', $data);
		$this->load->view('home/dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function browse(){
		$data['title'] = 'Browse';
		$data['users'] = $this->user_model->get_all_users();
		$data['groups'] = $this->group_model->get_all_groups();
		//Load our views
		$this->load->view('templates/header', $data);
		$this->load->view('home/browse', $data);
		$this->load->view('templates/footer');
	}

	// public function index(){
	// 	$data['title'] = 'Home';
	// 	//Load our views
	// 	$this->load->view('templates/homeheader', $data);
	// 	$this->load->view('home/home');
	// 	$this->load->view('templates/footer');
	// }

	public function resources(){
		$data['title'] = "Resources";
		$this->load->view('templates/header', $data);
		$this->load->view('home/resources');
		$this->load->view('templates/footer');
	}

	public function main_help(){
		$data['title'] = "Help";
		$this->load->view('templates/header', $data);
		$this->load->view('home/main_help');
		$this->load->view('templates/footer');
	}

	public function important_dates(){
		$data['title'] = "Important Dates";
		$this->load->view('templates/header', $data);
		$this->load->view('home/important_dates');
		$this->load->view('templates/footer');
	}

	public function general_help(){
		$data['title'] = "General Help";
		$this->load->view('templates/header', $data);
		$this->load->view('home/general_help');
		$this->load->view('templates/footer');
	}

}
?>
