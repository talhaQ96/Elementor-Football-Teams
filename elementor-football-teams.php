<?php
    /**
     * Plugin Name:  Elementor Football Teams
     * Plugin URI:   https://github.com/talhaQ96/
     * Description:  This Elementor widget displays Post Type Football Teams on the Front-End.
     * Version:      1.0
     * Author:       Talha Qureshi 
     * Author URI:   https://github.com/talhaQ96/
     **/

define('PLUGIN_ROOT_PATH', plugin_dir_path( __FILE__ ));

define('PLUGIN_ROOT_URL' , plugin_dir_url( __FILE__ ));

/**
 * Include the Elementor_Football_Teams class.
 * 
 * The main plugin file
 */
require PLUGIN_ROOT_PATH . 'class-elementor-football-teams.php';


