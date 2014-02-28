<?php
function checkSession(){
	$CI = & get_instance();
	if(!$CI->session->userdata('validated')){
        $this->session->sess_destroy();
        header('Location: https://cas.wpi.edu/cas/logout');
    }
}

?>