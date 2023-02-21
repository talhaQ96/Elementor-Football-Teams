<?php

/**
 * Custom Post Type Football Teams.
 * 
 * This file is reponsible for registering Custom Post Type `Football Teams` and it's Custom Taxonomy `League`
 */

// Exit if files accessed directly.
defined( 'ABSPATH' ) || die();

class PT_Football_Teams {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action('init', array($this, 'register_football_teams_post_type'));
	}


	/**
	 * Register Custom Post Type `Football Teams` & Custom Taxonomy `Leagues`
	 * 
	 * The function is called inside class constructor using `init` hook
	 */
	public function register_football_teams_post_type() {

		$ft_labels =  array(
			'name'                     => 'Football Teams',
			'singular_name'            => 'Football Team',
			'add_new_item'             => 'Add New Team',
			'edit_item'                => 'Edit Team',
			'new_item'                 => 'New Team',
			'view_item'                => 'View Team',
			'view_items'               => 'View Teams',
			'search_items'             => 'Search Teams',
			'not_found'                => 'No teams found',
			'not_found_in_trash'       => 'No teams found in Trash',
			'parent_item_colon '       => 'Parent Team',
			'all_items'			       => 'All Teams',
			'archives'			       => 'Team Archives',
			'attributes'		       => 'Team Attributes',
			'insert_into_item'	       => 'Insert into team',
			'uploaded_to_this_item'	   => 'Upload to this team',
			'filter_items_list'		   => 'Filter teams list',
			'items_list_navigation'    => 'Teams list navigation',
			'items_list'			   => 'Team list',
			'item_published'		   => 'Team published',
			'item_published_privately' => 'Team published privately',
			'item_reverted_to_draft'   => 'Team reverted to draft',
			'item_scheduled'           => 'Team scheduled',
			'item_updated'			   => 'Team updated',
			'item_link'				   => 'Team Link',
			'item_link_description'    => 'A link to a team'
		);

		$ft_args = array(
			'labels'  => $ft_labels,
			'public'  => true,
			'menu_position' => 3,
			'menu_icon' => 'dashicons-marker',
	  	    'has_archive' => true,
	  	    'taxonomies' => array('league'),
	  	    'supports' => array('title', 'editor', 'thumbnail'),
		);

	  	register_post_type('football_teams', $ft_args);

		$league_labels = array(
        	'name'              => 'Leagues',
        	'singular_name'     => 'League',
        	'search_items'      => 'Search Leagues',
        	'all_items'         => 'All Leagues',
        	'parent_item'       => 'Parent League',
        	'parent_item_colon' => 'Parent League:',
        	'edit_item'         => 'Edit League',
        	'update_item'       => 'Update League',
        	'add_new_item'      => 'Add New League',
        	'new_item_name'     => 'New League Name',
        	'menu_name'         => 'Leagues',
    	);

    	$league_args = array(
    	    'labels'            => $league_labels,
    	    'public'            => true,
    	    'hierarchical'      => true,
    	    'show_admin_column' => true
    	);

    	register_taxonomy('league', 'football_teams', $league_args);
	}
}

new PT_Football_Teams();