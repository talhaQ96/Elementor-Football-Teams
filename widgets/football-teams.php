<?php
/**
 * Football Teams Widget.
 * 
 * This file is reponsible for creating widget `Football Teams`
 */

namespace ElementorFootballTeams\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Exit if files accessed directly.
defined( 'ABSPATH' ) || die();


/**
 * Football Teams widget class.
 */
class Football_Teams extends Widget_Base {

	// get widget name
	public function get_name() {
		return 'football_teams';
	}

	// get widget title
    public function get_title() {
        return __( 'Football Teams', 'elementor-football-teams' );
    }

    // get widget icon
    public function get_icon() {
        return 'eicon-elementor-circle';
    }

    // get the list of cateogories to which widget belongs to
    public function get_categories() {
        return [ 'general' ];
    }


    /**
     *	This function is retrieves Term Names of Taxonomy League
     *  
     *  The function is called by `league control` inside `_register_controls` function
     */
	private function get_league_names() {

		$taxonomy = 'league'; // slug of custom post type, change to whatever post type you need

		$options = []; // array initialized, to store term names

	  	$terms = get_terms( [
	  	  'taxonomy' => $taxonomy,
	  	  'hide_empty' => false,
	  	]);
	
	  	foreach ($terms as $term){
	  		$options[ $term->term_id ] = $term->name;
	  	}
	
	  	return $options;
	}


    /**
     *	This function is reponsible for registering Widget Controls 
     */
	protected function _register_controls() {

		// *** Tab Begin: Filer & Display Football Teams ***
	    $this->start_controls_section(
	        'section_teams',
	        [
	            'label' => __( 'Filer & Display Football Teams', 'elementor-football-teams' ),
	            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	        ]
	    );

	    // Number field for selecting number of teams to display
	    $this->add_control(
	        'number_of_posts',
	        [
	            'label' => __( 'Number of Teams to Display', 'elementor-football-teams' ),
	            'type' => \Elementor\Controls_Manager::NUMBER,
	        ]
	    );

	    // Text field for keywords
	    $this->add_control(
	        'keywords',
	        [
	            'label' => __( 'Filter by Keyword', 'elementor-football-teams' ),
	            'type' => \Elementor\Controls_Manager::TEXT,
	            'label_block' => true,
	        ]
	    );
 
 		// Dropdown filter for selecting Terms of Taxonomy League.
        $this->add_control(
            'league',
            [
                'label' => __( 'Select Leagues', 'elementor-football-teams' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_league_names(),
            ]
        );

	    $this->end_controls_section();
	    // *** Tab End: Filer & Display Football Teams ***

	    // *** Tab Begin: Color Settings ***
		$this->start_controls_section(
	        'section_color_settings',
	        [
	            'label' => __( 'Color Settings', 'elementor-football-teams' ),
	            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	        ]
	    );

		// Color control for `Post Title`
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} h1' => 'color: {{VALUE}}',
				],
			]
		);

		// Color control for heading `Nick Name`
		$this->add_control(
			'nick_color',
			[
				'label' => esc_html__( 'Nick Name Color', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{SELECTOR}} .nick-name' => 'color: {{VALUE}}',
				],
			]
		);

		// Color control for heading `Leagues`
		$this->add_control(
			'league_heading_color',
			[
				'label' => esc_html__( 'Leagues Color', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{SELECTOR}} .leagues-heading' => 'color: {{VALUE}}',
				],
			]
		);

		// Color control for leagues list
		$this->add_control(
			'league_list_color',
			[
				'label' => esc_html__( 'Leagues List Color', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}}',
				],
			]
		);

		// Color control for heading `History`
		$this->add_control(
			'history_color',
			[
				'label' => esc_html__( 'History Title Color', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{SELECTOR}} .head-history' => 'color: {{VALUE}}',
				],
			]
		);

		// Color control for content
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'History Content Color', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} p' => 'color: {{VALUE}}',
				],
			]
		);

	    $this->end_controls_section();
	    // *** Tab End: Color Settings ***


	    // *** Tab Begin: Fonts Settings ***
		$this->start_controls_section(
	        'section_fonts_settings',
	        [
	            'label' => __( 'Font Settings', 'elementor-football-teams' ),
	            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	        ]
	    );

		// Font control for Post Tile
		$this->add_control(
			'font_family_title',
			[
				'label' => esc_html__( 'Title Font', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{WRAPPER}} h1' => 'font-family: {{VALUE}}',
				],
			]
		);

		// Font control for Nick Name
		$this->add_control(
			'font_family_nick_name',
			[
				'label' => esc_html__( 'Nick Name Font', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{SELECTOR}} .nick-name' => 'font-family: {{VALUE}}',
				],
			]
		);

		// Font control for heading `Leagues`
		$this->add_control(
			'font_family_leagues_heading',
			[
				'label' => esc_html__( 'Leagues Font', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{SELECTOR}} .leagues-heading' => 'font-family: {{VALUE}}',
				],
			]
		);

		// Font control for leagues list
		$this->add_control(
			'font_family_leagues_list',
			[
				'label' => esc_html__( 'Leagues List Font', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{WRAPPER}} a' => 'font-family: {{VALUE}}',
				],
			]
		);

		// Font control for heading `History`
		$this->add_control(
			'font_family_history',
			[
				'label' => esc_html__( 'History Title Font', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{SELECTOR}} .head-history' => 'font-family: {{VALUE}}',
				],
			]
		);

		// Font control for History content
		$this->add_control(
			'font_family_content',
			[
				'label' => esc_html__( 'History Content Font', 'elementor-football-teams' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{WRAPPER}} p' => 'font-family: {{VALUE}}',
				],
			]
		);

	    $this->end_controls_section();
	    // *** Tab End: Fonts Settings ***
	}


    /**
     *	This function renders the output of Widget 
     */
	protected function render() {

  		$settings = $this->get_settings_for_display();

  		$leagues    = $settings['league']; // list of leagues selected using widget control `league`
  		$keywords   = $settings['keywords']; 
  		$post_count = $settings['number_of_posts'];

		$args = [
		  'post_type' => 'football_teams',
		  'posts_per_page' => $post_count,
		  's' => $keywords,
		];

		// check if options were selected from widget control `league` and is not left empy
	  	if (!empty($leagues)) {
	    	$args['tax_query'] = [
	    	  [
	    	    'taxonomy' => 'league',
	    	    'field' => 'term_id',
	    	    'terms' => $leagues,
	    	  ],
	    	];
	  	}

	  	$query = new \WP_Query( $args );

		if ($query->have_posts()):
?>
			<div class="team-grid">
				<?php 
					while ($query->have_posts()):
			      		$query->the_post();
			      		$post_id = get_the_ID();
			      		$team_nick_name = get_post_meta($post_id, 'nick_name_field_key', true);
			      		$team_logo = get_post_meta($post_id, 'logo_field_key', true);
			      		$leagues = get_the_terms($post_id, 'league');
				?>
							<div>
								<?php
						      		if(!empty($team_logo)){
						      			echo '<img src="'. $team_logo .'" />';
						      		}
				
						      		echo '<h1>'. get_the_title() .'</h1>';
				
						      		if(!empty($team_nick_name)){
						      			echo '<h2 class="nick-name">Nick Name:'. $team_nick_name .'</h2>';
						      		}

						      		if(!empty($leagues)):
						      	?>
						      			<h2 class="leagues-heading">Leagues</h2>
						      			<ul>
						      				<?php
						      					for ($i=0; $i<count($leagues); $i++):

						      						$league_id = $leagues[$i]->term_id;
						      						$league_name = $leagues[$i]->name;
						      						$league_logo_url = get_term_meta($league_id, 'league_logo_field_key', true);
						      						$league_archive_url = get_term_link($league_id);
						      				?>
						      						<li>
						      							<a href="<?php echo $league_archive_url; ?>">
						      								<span><img src="<?php echo $league_logo_url; ?>" alt="" /></span>
						      								<span><?php echo $league_name; ?></span>
						      							</a>
						      						</li>
						      				<?php endfor; ?>
						      			</ul>
						      	<?php		
						      		endif;

			      					if(get_the_content()){
			      						echo '<h2 class="head-history">History</h2>';
	
			      						the_content();
			      					}
								?>
							</div>
				<?php endwhile; ?>
			</div>
<?php
		endif;
  		
  		wp_reset_postdata();
	}
}