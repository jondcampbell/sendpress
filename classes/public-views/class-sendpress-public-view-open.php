<?php

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

class SendPress_Public_View_Open extends SendPress_Public_View{
	
	function page_start(){}

	function page_end(){}

	function html($sp){
		$ip = $_SERVER['REMOTE_ADDR'];
		$info = $this->data();
		$link = $sp->track_open($info->id , $info->report , $ip , $this->_device_type, $this->_device );
		header('Content-type: image/gif'); 
		include(SENDPRESS_PATH. 'img/clear.gif'); 	
	}

}