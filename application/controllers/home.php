<?php
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function dashboard(){
		$data['title'] = 'Dashboard';
		//Load our views
		$this->load->view('templates/header', $data);
		$this->load->view('home/dashboard');
		$this->load->view('templates/footer');
	}

	public function browse(){
		$data['title'] = 'Browse';
		$data['users'] = $this->user_model->get_all_users();
		//Load our views
		$this->load->view('templates/header', $data);
		$this->load->view('home/browse', $data);
		$this->load->view('templates/footer');
	}

	public function index(){
		$data['title'] = 'Home';
		//Load our views
		$this->load->view('templates/header', $data);
		$this->load->view('home/home');
		$this->load->view('templates/footer');
	}
}
?>