<?php
function checkSession(){
    echo getenv("CAS_UID")
	$CI = & get_instance();
    //$CI->session->sess_destroy();
	if(!$CI->session->userdata('validated')){
        //Do CAS Stuff
        
        //Load in CAS Stuff
        $sessData = array(
			'user_id' => 4,
			'validated' => true
		);

		$CI->session->set_userdata($sessData);
    }
    else{
    	echo "<pre>";
    	print_r($CI->session->userdata);
    	echo "</pre>";
    }
}

?>