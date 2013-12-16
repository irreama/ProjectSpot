<?php
class Invites extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Invites';
		//Load our views
		$this->load->view('templates/homeheader');
		$this->load->view('invites/invites');
		$this->load->view('templates/footer');
	}
}
?>
