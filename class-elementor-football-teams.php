<?php

/**
 * Elementor_Football_Teams Class.
 * 
 * Main Plugin File
 */

// Exit if files accessed directly.
defined( 'ABSPATH' ) || die();

class Elementor_Football_Teams {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action('plugins_loaded', array($this, 'load_required_files'));

		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));

		add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
	}


	/**
	 * The function loads all required files for the plugin to function properly.
	 * 
	 * The function is called inside class constructor using `plugins_loaded` hook
	 */
	public function load_required_files() {

		// Check if Elementor is active

		if (is_plugin_active('elementor/elementor.php')) {

			require_once 'class-widgets.php';
	
			require_once 'post-types/football-teams.php';
	
			require_once 'custom-fields/nick-name.php';
	
			require_once 'custom-fields/team-logo.php';
	
			require_once 'custom-fields/league-logo.php';
		}

		// if Elementor is not active
		else {
			add_action('admin_notices', array($this, 'dependent_plugin_elementor_missing'));
		}
	}


	/**
	 * The function loads all required assets for Front-End.
	 * 
	 * The function is called inside class constructor using `wp_enqueue_scripts` hook
	 */
	public function enqueue_frontend_assets() {
		wp_enqueue_style('elementor-football-teams-css', PLUGIN_ROOT_URL . 'assets/css/elementor-football-teams.css');
	}


	/**
	 * The function loads all required assets for Admin.
	 * 
	 * The function is called inside class constructor using `admin_enqueue_scripts` hook
	 */
	public function enqueue_admin_assets() {
		wp_enqueue_script('elementor-football-teams-js', PLUGIN_ROOT_URL . 'assets/js/elementor-football-teams.js' , '', '', true);

    	if (!wp_script_is('jquery', 'enqueued')) {
    	    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    	}
	}


	/**
	 * Displays error message upon activation if Elementor is not installed or activated
	 * 
	 * The function is called in function `load_required_files` inside else block using `admin_notice` hook
	 */
	public function dependent_plugin_elementor_missing() {
	    echo "<div class='error'><p>Elementor Football Teams requires Elementor Plugin to be installed and activated</p></div>";
	}
}

new Elementor_Football_Teams();