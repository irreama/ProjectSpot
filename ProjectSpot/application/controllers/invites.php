<?php
class Invites extends CI_Controller {

	public function __construct(){
		parent::__construct();
		checkSession();
	}

	public function index(){
		$data['title'] = 'Invites';
		$uid = $this->session->userdata('user_id');
		$data['uid'] = $uid;

		//Grab all recieved invites
		$this->load->model("group_user_rel_model");
		$this->load->model("group_model");
		$this->load->model("user_model");

		$incoming = $this->group_user_rel_model->getIncomingInvitesByUserId($uid);

		$groups = $this->group_user_rel_model->get_all_groups_by_user_id($uid);

		$data['invites']['incoming'] = array();
		$data['invites']['outgoing'] = array();

		foreach($incoming as $incomingInvite){
			$incomingInvite['group'] = $this->group_model->get_group_by_id($incomingInvite['group_id']);
			$data['invites']['incoming']['group'][] = $incomingInvite;
		}

		foreach($groups as $aGroup){
			//Grab requests to join this group
			$requests = $this->group_user_model->getRequestedInvitesByGroupId($aGroup['id']);

			foreach($requests as $aRequest){
				$requester = $this->user_model->get_user_by_id($aRequest['user_id']);
				$data['invites']['incoming']['requests'][] = array(
					'id' => $aRequest['id'],
					'group' => $aGroup,
					'requester' => $requester
				);
			}
			
			//Grab outgoing requests to join a group
			$outgoing = $this->group_user_rel_model->getSentInvitesByGroupId($aGroup['id']);
			foreach($outgoing as $outgoingInvite){
				$outgoingInvite['sender'] = $this->user_model->get_user_by_id($outgoingInvite['invited_by']);
				$outgoingInvite['recipient'] = $this->user_model->get_user_by_id($outgoingInvite['user_id']);

				if($outgoingInvite['recipient']['user_status'] == "Advisor"){
					$data['invites']['outgoing']['advisors'][] = $outgoingInvite;
				}
				else{
					$data['invites']['outgoing']['students'][] = $outgoingInvite;
				}
				
			}
		}

		
		//Load our views
		$this->load->view('templates/header', $data);
		$this->load->view('invites/invites', $data);
		$this->load->view('templates/footer');
	}
}
?>
