<?php

class Pages extends CI_Controller{

	public function view($page = 'home'){
		if(!file_exists('application/views/pages/'.$page.'.php')){
			//Don't have a page for this
			show_404();
		}

		$data['title'] = ucfirst($page); //Capitalize the first letter

		$this->load->view('templates/header', $data);
		$this->load->view('pages')
	}
}

?>