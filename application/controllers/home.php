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
		$this->load->view('templates/homeheader');
		$this->load->view('home/home');
		$this->load->view('templates/footer');
	}

	public function resources(){
		$data['title'] = "Resources"
		$this->load('templates/header');
		$this->load->view('home/resources');
		$this->load('templates/footer');
	}

	public function help(){
		$data['title'] = "Help"
		$this->load('templates/header');
		$this->load->view('home/help');
		$this->load('templates/footer');
	}

	public function important_dates(){
		$data['title'] = "Important Dates"
		$this->load('templates/header');
		$this->load->view('home/important_dates');
		$this->load('templates/footer');
	}

	public function general_help(){
		$data['title'] = "General Help"
		$this->load('templates/header');
		$this->load->view('home/general_help');
		$this->load('templates/footer');
	}

}
?>
