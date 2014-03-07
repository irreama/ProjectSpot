<?php
class Dates extends CI_Controller {

	public function __construct(){
		parent::__construct();
		checkSession();
		adminCheck();
		$this->load->model('dates_model');

	}

	public function index(){
		$data['title'] = 'Admin Panel - Dates';
		$data['dates'] = $this->dates_model->getAllDates();

		$this->load->view('templates/header', $data);
		$this->load->view('admin/dates/list', $data);
		$this->load->view('templates/footer');
	}

	public function add(){
		$data['title'] = 'Admin Panel - Dates - New';

		$this->load->view('templates/header', $data);
		$this->load->view('admin/dates/new');
		$this->load->view('templates/footer');
	}


}
?>