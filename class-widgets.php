<?php
/**
 * Widgets class.
 * 
 * This classs is responsible for registering the Elementor Widgets.
 */

namespace ElementorFootballTeams;

// Exit if files accessed directly.
defined( 'ABSPATH' ) || die();

class Widgets {

	private static $instance = null;

	/**
	 * Calls register widget function
	 */
	public function __construct() {
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
	}


	/**
	 * This function ensures only one instance of the class is loaded or can be loaded.
	 */
	public static function instance() {
		if (is_null( self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * This function loads widget files
	 */
	private function include_widgets_files() {
		require_once 'widgets/football-teams.php';
	}


	/**
	 * This functions registers the new Elementor widgets.
	 */
	public function register_widgets() {

		$this->include_widgets_files();

		// Register the plugin widget classes.
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Football_Teams());
	}
}

// Instantiate the Widgets class.
Widgets::instance();