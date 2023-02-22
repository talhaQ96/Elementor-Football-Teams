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
 *  Includes the plugin.php file located in the wp-admin/includes directory of a WordPress installation
 * 
 *  Including it here to use function `is_plugin_active()` inside file `class-elementor-football-teams.php`
 */

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Includes the Elementor_Football_Teams class.
 * 
 * The main plugin file
 */
require PLUGIN_ROOT_PATH . 'class-elementor-football-teams.php';