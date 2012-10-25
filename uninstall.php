<?php
/**
* SendPress Uninstall Scripts
*
* 
* @package  SendPress
* @author   Josh Lyford
* @since 	0.8.6
*/

//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit ();

//Remove settings
delete_option('sendpress_options');
delete_option('sendpress_db_version');

//Drop All DB tables 
//This could use an updated for Multisite
require_once( plugin_dir_path(__FILE__)  . 'inc/classes/class-sp-table-manager.php' );
SendPress_Table_Manager::remove_all_data();