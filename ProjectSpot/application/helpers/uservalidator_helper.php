<?php
function checkSession(){
	$CI = & get_instance();
	echo "<pre>";
	print_r($CI->session->all_userdata());
	echo "</pre>";
	if(!$CI->session->userdata('validated')){
        $CI->session->sess_destroy();
        redirect('/login');
    }
}

function adminCheck(){
	$CI = & get_instance();
	if(!$CI->session->userdata('user_is_admin')){
		redirect('/');
	}
}

?>