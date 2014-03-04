<?php
function checkSession(){
	$CI = & get_instance();
	if(!$CI->session->userdata('validated')){
        $CI->session->sess_destroy();
        redirect('/login');
    }
}

?>