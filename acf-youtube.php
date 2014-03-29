<?php
/*
Plugin Name: Advanced Custom Fields: Youtube 
Plugin URI: 
Description: Add-On plugin for Advanced Custom Fields (ACF) that adds a 'Youtube' Field type.
Version: 0.0.0
Author: Joseph Niet
Author URI: josephniet.net
License: GPL2 or later
*/


class acf_field_youtube_plugin
{
	/*
	*  Construct
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 1/04/13
	*/
	
	function __construct()
	{
		// set text domain
		/*
		$domain = 'acf-nav_menu';
		$mofile = trailingslashit(dirname(__File__)) . 'lang/' . $domain . '-' . get_locale() . '.mo';
		load_textdomain( $domain, $mofile );
		*/
		
		
		// version 4+
		add_action('acf/register_fields', array($this, 'register_fields'));	
		add_action('acf/input/admin_head', array($this, 'setup_scripts'));
	}
	
	/*
	*  register_fields
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 1/04/13
	*/
	
	function register_fields()
	{
		include_once('youtube-v4.php');
	}
	
	function setup_scripts(){
		include_once('head.php');	
	}
}

new acf_field_youtube_plugin();
		
?>