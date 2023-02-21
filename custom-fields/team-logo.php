<?php

/**
 * Custom Field Team Logo.
 * 
 * This file is reponsible for registering custom field `Team Logo` on post type `Football Teams`
 */

// Exit if files accessed directly.
defined( 'ABSPATH' ) || die();

class CF_Team_Logo {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action('add_meta_boxes', array($this, 'register_team_logo_field'));

		add_action( 'save_post', array($this, 'save_logo_field'));
	}


	/**
	 * Register Custom Image Field `Team Logo`.
	 * 
	 * The function is called inside class constructor using `add_meta_boxes` hook
	 */
	public function register_team_logo_field() {
	    add_meta_box(
	        'logo_meta_box',
	        __('Team Logo', 'text-domain'),
	        array($this, 'render_logo_field'),
	        'football_teams',
	        'side'
	    );
	}


	/**
	 * Contains the ouput code to be rendered for Custom Field `Team Logo`.
	 */
	public function render_logo_field($post) {
		wp_nonce_field('save_logo_field', 'logo_field_nonce');
	
	  	$logo_url = get_post_meta($post->ID, 'logo_field_key', true);
?>

        <div class="form-field term-group">
            <input type="hidden" id="logo" name="logo" value="<?php echo esc_attr($logo_url); ?>">

            <img src = "<?php echo $logo_url; ?>" id="img-logo" style="display: block; margin: 20px 0; max-width: 100px;" />

            <p>
                <input type="button" class="button" id="logo-upload-button" name="" value="Add Logo" />
                <input type="button" class="button" id="logo-remove-button" name="" value="Remove Logo" />
            </p>
        </div>
<?php
	}


	/**
	 * Updates the value of Custom Field `Team Logo`.
	 * 
	 * The function is called inside class constructor using `save_post` hook
	 */
	public function save_logo_field($post_id) {
		if (! isset( $_POST['logo_field_nonce'] ) || ! wp_verify_nonce($_POST['logo_field_nonce'], 'save_logo_field')) {
		  return;
		}
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		  return;
		}
		
		if (!current_user_can('edit_post', $post_id)){
		  return;
		}
		
		if (isset($_POST['logo'])) {
		  update_post_meta( $post_id, 'logo_field_key', sanitize_text_field($_POST['logo']));
		}
	}
}

new CF_Team_Logo();