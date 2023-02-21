<?php

/**
 * Custom Field Nick Name.
 * 
 * This file is reponsible for registering custom field `Nick Name` on post type `Football Teams`
 */

// Exit if files accessed directly.
defined( 'ABSPATH' ) || die();

class CF_Nick_Name {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action('add_meta_boxes', array($this, 'register_nick_name_field'));

		add_action( 'save_post', array($this, 'save_nick_name_field'));
	}


	/**
	 * Register Custom Text Field `Nick Name`.
	 * 
	 * The function is called inside class constructor using `add_meta_boxes` hook
	 */
	public function register_nick_name_field() {
		add_meta_box(
		  'nick_name_meta_box',
		  __('Nick Name', 'text-domain'),
		  array($this, 'render_nick_name_field'),
		  'football_teams',
		  'side'
		);
	}


	/**
	 * Contains the ouput code to be rendered for Custom Field `Nick Name`.
	 */
	public function render_nick_name_field($post) {
		wp_nonce_field('save_nick_name_field', 'nick_name_field_nonce');
	
	  	$nick_value = get_post_meta($post->ID, 'nick_name_field_key', true);

	  	echo '<label for="nick_name">Custom Field:</label>';

	  	echo '<input type="text" id="nick_name" name="nick_name" value="'. esc_attr($nick_value) .'">';
	}


	/**
	 * Updates the value of Custom Field `Nick Name`.
	 * 
	 * The function is called inside class constructor using `save_post` hook
	 */
	public function save_nick_name_field($post_id) {
		if (! isset( $_POST['nick_name_field_nonce'] ) || ! wp_verify_nonce($_POST['nick_name_field_nonce'], 'save_nick_name_field')) {
		  return;
		}
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		  return;
		}
		
		if (!current_user_can('edit_post', $post_id)){
		  return;
		}
		
		if (isset($_POST['nick_name'])) {
		  update_post_meta( $post_id, 'nick_name_field_key', sanitize_text_field($_POST['nick_name']));
		}
	}
}

new CF_Nick_Name();