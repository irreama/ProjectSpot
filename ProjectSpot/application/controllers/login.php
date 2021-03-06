<?php
class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function loginHandler(){

    	//Invalidate the current session
    	//Can't destroy the session, otherwise we lose access to it for some reason?
    	$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('validated');

		//$uid = "";
		$uid = getenv("REMOTE_USER");
		$this->load->model("user_model");

		$user = $this->user_model->get_user_by_user_login($uid);

		if(empty($user)){
			$ds = ldap_connect("ldapv2.wpi.edu");
			$dn = "dc=wpi,dc=edu";
			$filter = "uid=$uid";
			//$attr = array("edupersonprimaryaffiliation", "givenname", "sn", "mail", "uid", "wpieduPersonMajor");
			$sr = ldap_search($ds, $dn, $filter);
			if($sr){
				$this->load->model("major_model");
				$info = ldap_get_entries($ds, $sr);

				if($info['count']){
					$user['user_login'] = $info[0]['uid'][0];
					$user['user_first_name'] = $info[0]['givenname'][0];
					$user['user_last_name'] = $info[0]['sn'][0];
					if($info[0]['edupersonprimaryaffiliation'][0] == "student"){
						$user['user_status'] = "Student";
						$user['user_major1'] = $this->major_model->getMajorIdByLdap($info[0]['wpiedupersonmajor'][0]);
					}
					else if($info[0]['edupersonprimaryaffiliation'][0] == "faculty"){
						$user['user_status'] = "Advisor";
						$user['user_major1'] = $this->major_model->getMajorIdByName($info[0]['ou'][0]);
					}
					else{
						$user['user_status'] = "Other";
					}
					
					$user['user_email'] = $info[0]['mail'][0];

					$newId = $this->user_model->new_user($user);
					if($newId){
						$sessData = array(
							'user_id' => $newId,
							'display_name' => $user['user_first_name'].' '.$user['user_last_name'],
							'validated' => true,
							'user_is_admin' => $user['user_is_admin']
						);

						$this->session->set_userdata($sessData);
						redirect('/');
					}
					else{
						//Load our views
						$this->load->view('templates/homeheader');
						$this->load->view('login/login');
						$this->load->view('templates/footer');
					}
				}
				else{
					//Load our views
					$this->load->view('templates/homeheader');
					$this->load->view('login/login');
					$this->load->view('templates/footer');
				}
			}
			ldap_close($ds);
		}
		else{
			$sessData = array(
				'user_id' => $user['id'],
				'display_name' => $user['user_first_name'].' '.$user['user_last_name'],
				'validated' => true,
				'user_is_admin' => $user['user_is_admin']
			);

			$this->session->set_userdata($sessData);
			redirect('/');
		}
    }

    public function logoutHandler(){
    	$this->session->sess_destroy();
    	header('Location: https://cas.wpi.edu/cas/logout');
    }

}

?>