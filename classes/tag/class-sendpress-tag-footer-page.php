<?php
// Prevent loading this file directly
if ( !defined('SENDPRESS_VERSION') ) {
	header('HTTP/1.0 403 Forbidden');
	die;
}


class SendPress_Tag_Footer_Page extends SendPress_Tag_Base  {

	static function internal( $template_id , $email_id, $subscriber_id , $example ) {
		$return = self::external( $template_id ,$email_id, $subscriber_id , $example );
		if( $return != '' ){
			return self::table_start() . $return . self::table_end();
		}
        return '';
	}
	
	static function external(  $template_id , $email_id , $subscriber_id, $example ){
		//if( $example == false ){
			$content = get_post_meta( $template_id , '_footer_page' , true); // get_post_meta($email_id);
			//$content = $content_post->post_content;
			
			
			remove_filter('the_content','wpautop');
			$content = apply_filters('the_content', $content);
			add_filter('the_content','wpautop');
			$content = nl2br(str_replace(']]>', ']]&gt;', $content));
		/*
		} else {
			$content = self::lipsum_format();
		}
		*/
		 if($content != ''){
		 	return self::table_start( $template_id ) . $content . self::table_end();
		 }
		 return '';
		
	}

	static function content(){
		$display_correct = __("Is this email not displaying correctly?","sendpress");
		$view = __("View it in your browser","sendpress");
		return $display_correct . ' <a href="{sp-browser-link}">'.$view.'</a>';
	}
	

	static function copy(){
		$return =  '<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td align="left">';
        $return .= '{header-content}';
        $return .='</td></tr></table>';
        return $return;
	}

	static function table_start( $template_id ){
		$htext = get_post_meta( $template_id ,'_header_page_text_color',true );
		if($htext == false ){
			$htext = '#333';
		}
		
		$return ='';
        $padding = get_post_meta( $template_id ,'_header_padding',true );
        $pd = '';
        if( $padding == 'pad-page'  ){
        	 $pd = ' padding-left: 30px; padding-right: 30px; ';
    	}
    	$return .='<table border="0" width="100%" height="100%" class="sp-body-bg" cellpadding="0" cellspacing="0">';
    	$return .='<tr>';
      	$return .='<td align="center" valign="top">';
		$return .='<!-- 600px container Header - SendPress_Tag_Footer_Page-->';
	    $return .='<table border="0" width="600" cellpadding="0" cellspacing="0" class="container " >';
	    $return .='<tr>';
	    $return .='<td class="container-padding page-text-color" style="'.$pd.' font-size: 13px; line-height: 20px; font-family: Helvetica, sans-serif; color: '.$htext.';" align="left">';
	   
	    return $return;
	}
	static function table_end(){
		$return ='';
		$return .='</td>';
	    $return .='</tr>';
	    $return .='</table>';
		$return .='</td>';
	    $return .='</tr>';
	    $return .='</table>';
	    return $return;
	}
}