<?php

/**
 * Custom Field League Logo.
 * 
 * This file is reponsible for registering custom field `League Logo` for taxonomy `Leagues`
 */

// Exit if files accessed directly.
defined( 'ABSPATH' ) || die();

class CF_League_Logo {
    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_media'));

        add_action('league_add_form_fields', array($this, 'render_league_logo_field'), 10, 2);

        add_action('league_edit_form_fields', array ( $this, 'render_league_logo_field_on_edit_screen' ), 10, 2);

        add_action('created_league', array ( $this, 'save_league_logo_field'), 10, 2 );

        add_action('edited_league', array ( $this, 'save_league_logo_field' ), 10, 2);
    }

    /**
     * Enqueues all scripts, styles, settings, and templates necessary to use all media JS APIs.
     * 
     * Using it here to open Media Gallery for adding League Logo
     * 
     * The function is called inside class constructor using `admin_enqueue_scripts` hook 
     */
    public function enqueue_media() {
        wp_enqueue_media();
    }


    /**
     * Contains the ouput code to be rendered for Custom Field `League Logo` on Taxonomy Page `Leagues`.
     * 
     * The function is called inside class constructor using `league_add_form_fields` hook
     */
    public function render_league_logo_field () {
        wp_nonce_field('save_league_logo_field', 'league_logo_field_nonce');
?>
        <div class="form-field term-group">
            <label for="category-image-id">League Logo</label>
            <input type="hidden" id="league-logo" name="league-logo" value="">

            <img src="" id="img-league-logo" style="margin: 20px 0; max-width: 100px;" />

            <p>
                <input type="button" class="button" id="league-logo-upload-button" name="" value="Add Logo" />
                <input type="button" class="button" id="league-logo-remove-button" name="" value="Remove Logo" />
            </p>
        </div>
<?php
    }


    /**
     * Contains the ouput code to be rendered for Custom Field `League Logo` on Terms Page of Taxonomy `Leagues`.
     * 
     * The function is called inside class constructor using `league_edit_form_fields` hook
     */
    public function render_league_logo_field_on_edit_screen ($term, $taxonomy) {
        wp_nonce_field('save_league_logo_field', 'league_logo_field_nonce');

        $league_logo_url = get_term_meta($term->term_id, 'league_logo_field_key', true);
?>
        <tr class="form-field term-group-wrap">
            <th><label for="category-image-id">League Logo</label></th>

            <td>
                <input type="hidden" id="league-logo" name="league-logo" value="<?php echo $league_logo_url; ?>">

                <img src="<?php echo $league_logo_url; ?>" id="img-league-logo" style="margin: 20px 0; max-width: 100px;" />

                <p>
                    <input type="button" class="button" id="league-logo-upload-button" name="" value="Add Logo" />
                    <input type="button" class="button" id="league-logo-remove-button" name="" value="Remove Logo" />
                </p>
            </td>
        </tr>
<?php
    }


    /**
     * Updates the value of Custom Field `League Logo`.
     * 
     * The function is called inside class constructor using `created_league` and `edited_league` hook
     */
    public function save_league_logo_field ($term_id, $tt_id) {

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
          return;
        }
        
        if (!current_user_can('edit_term', $term_id)){
          return;
        }

        if (isset($_POST['league-logo'])) {
          update_term_meta( $term_id, 'league_logo_field_key', sanitize_text_field($_POST['league-logo']));
        }
    }
}

new CF_League_Logo();