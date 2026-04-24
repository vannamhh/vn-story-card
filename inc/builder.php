<?php
/**
 * VN Story Card Builder
 *
 * Registers the VN Story Card UX Builder element.
 *
 * @package vn-story-card
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the VN Story Card UX Builder element.
 *
 * @since 1.0.0
 * @return void
 */
function vnsc_builder_element() {
	if ( ! function_exists( 'add_ux_builder_shortcode' ) ) {
		return;
	}

	add_ux_builder_shortcode(
		'vn_story_card',
		array(
			'name'      => __( 'VN Story Card', 'vn-story-card' ),
			'category'  => __( 'Content' ),
			'thumbnail' => get_template_directory_uri() . '/inc/builder/shortcodes/thumbnails/team_member.svg',
			'template'  => vnsc_builder_template( 'vn-story-card.html' ),
			'info'      => '{{ title }}',
			'wrap'      => false,
			'options'   => array(
				'post_options'   => array(
					'type'    => 'group',
					'heading' => __( 'Bài viết', 'vn-story-card' ),
					'options' => array(
						'post_id' => array(
							'type'       => 'select',
							'heading'    => __( 'Chọn bài viết', 'vn-story-card' ),
							'full_width' => true,
							'config'     => array(
								'placeholder' => __( 'Chọn bài viết...', 'vn-story-card' ),
								'postSelect'  => array(
								'posts_per_page' => -1,
							),
							),
						),
					),
				),
				'content_options' => array(
					'type'    => 'group',
					'heading' => __( 'Nội dung', 'vn-story-card' ),
					'options' => array(
						'title'       => array(
							'type'        => 'textfield',
							'heading'     => __( 'Tiêu đề', 'vn-story-card' ),
							'placeholder' => __( 'Để trống sẽ lấy tiêu đề bài viết', 'vn-story-card' ),
							'default'     => '',
							'auto_focus'  => true,
						),
						'button_text' => array(
							'type'    => 'textfield',
							'heading' => __( 'Button label', 'vn-story-card' ),
							'default' => 'Nội dung câu chuyện',
						),
					),
				),
				'link_options'   => array(
					'type'    => 'group',
					'heading' => __( 'Liên kết', 'vn-story-card' ),
					'options' => array(
						'link'   => array(
							'type'        => 'textfield',
							'heading'     => __( 'Link', 'vn-story-card' ),
							'placeholder' => __( 'Để trống sẽ lấy link bài viết', 'vn-story-card' ),
							'default'     => '',
						),
						'target' => array(
							'type'    => 'select',
							'heading' => __( 'Target', 'vn-story-card' ),
							'default' => '',
							'options' => array(
								''       => __( 'Same window', 'vn-story-card' ),
								'_blank' => __( 'New window', 'vn-story-card' ),
							),
						),
					),
				),
				'image_options'  => array(
					'type'    => 'group',
					'heading' => __( 'Hình ảnh', 'vn-story-card' ),
					'options' => array(
						'image' => array(
							'type'    => 'image',
							'heading' => __( 'Ảnh đại diện', 'vn-story-card' ),
						),
					),
				),
				'advanced'       => array(
					'type'    => 'group',
					'heading' => __( 'Nâng cao', 'vn-story-card' ),
					'options' => array(
						'class'      => array(
							'type'    => 'textfield',
							'heading' => __( 'CSS class', 'vn-story-card' ),
							'default' => '',
						),
						'visibility' => array(
							'type'    => 'select',
							'heading' => __( 'Visibility', 'vn-story-card' ),
							'default' => '',
							'options' => array(
								''                => 'Visible',
								'hidden'          => 'Hidden',
								'hide-for-medium' => 'Hide for Medium/Mobile',
								'show-for-medium' => 'Show for Medium/Mobile only',
								'show-for-small'  => 'Show for Mobile only',
								'hide-for-small'  => 'Hide for Mobile',
							),
						),
					),
				),
			),
		)
	);
}

add_action( 'ux_builder_setup', 'vnsc_builder_element' );

/**
 * Register the VN Story Cards (Slider) UX Builder container element.
 *
 * @since 1.1.0
 * @return void
 */
function vnsc_builder_slider() {
	if ( ! function_exists( 'add_ux_builder_shortcode' ) ) {
		return;
	}

	add_ux_builder_shortcode(
		'vn_story_cards',
		array(
			'type'      => 'container',
			'name'      => __( 'VN Story Cards Slider', 'vn-story-card' ),
			'category'  => __( 'Content' ),
			'thumbnail'  => get_template_directory_uri() . '/inc/builder/shortcodes/thumbnails/slider.svg',
			'template'   => vnsc_builder_template( 'vn-story-cards.html' ),
			'info'       => '{{ label }}',
			'wrap'       => false,
			'message'    => __( 'Thêm story card vào đây', 'vn-story-card' ),
			'allow'      => array( 'vn_story_card' ),
			'toolbar'   => array(
				'show_children_selector' => true,
				'show_on_child_active'   => true,
			),
			'children'  => array(
				'inline'         => true,
				'addable_spots'  => array( 'left', 'right' ),
			),
			'presets'   => array(
				array(
					'name'    => __( 'Default', 'vn-story-card' ),
					'content' => '[vn_story_cards hide_nav="true" nav_pos="outside" nav_style="simple" nav_color="dark" bullets="false" timer="4000"][vn_story_card][/vn_story_cards]',
				),
			),
			'options'   => array(
				'label'          => array(
					'type'        => 'textfield',
					'heading'     => __( 'Admin label', 'vn-story-card' ),
					'placeholder' => __( 'Enter admin label...', 'vn-story-card' ),
				),
				'nav_options'    => array(
					'type'    => 'group',
					'heading' => __( 'Navigation' ),
					'options' => array(
						'hide_nav'     => array(
							'type'    => 'radio-buttons',
							'heading' => __( 'Always Visible' ),
							'default' => '',
							'options' => array(
								''     => array( 'title' => 'Off' ),
								'true' => array( 'title' => 'On' ),
							),
						),
						'nav_pos'      => array(
							'type'    => 'select',
							'heading' => __( 'Position' ),
							'default' => '',
							'options' => array(
								''        => 'Inside',
								'outside' => 'Outside',
							),
						),
						'nav_size'     => array(
							'type'    => 'select',
							'heading' => __( 'Size' ),
							'default' => 'large',
							'options' => array(
								'large'  => 'Large',
								'normal' => 'Normal',
							),
						),
						'arrows'       => array(
							'type'    => 'radio-buttons',
							'heading' => __( 'Arrows' ),
							'default' => 'true',
							'options' => array(
								'false' => array( 'title' => 'Off' ),
								'true'  => array( 'title' => 'On' ),
							),
						),
						'nav_style'    => array(
							'type'    => 'select',
							'heading' => __( 'Arrow Style' ),
							'default' => 'circle',
							'options' => array(
								'circle' => 'Circle',
								'simple' => 'Simple',
								'reveal' => 'Reveal',
							),
						),
						'nav_color'    => array(
							'type'    => 'radio-buttons',
							'heading' => __( 'Arrow Color' ),
							'default' => 'light',
							'options' => array(
								'dark'  => array( 'title' => 'Dark' ),
								'light' => array( 'title' => 'Light' ),
							),
						),
						'bullets'      => array(
							'type'    => 'radio-buttons',
							'heading' => __( 'Bullets' ),
							'default' => 'true',
							'options' => array(
								'false' => array( 'title' => 'Off' ),
								'true'  => array( 'title' => 'On' ),
							),
						),
						'bullet_style' => array(
							'type'    => 'select',
							'heading' => __( 'Bullet Style' ),
							'default' => 'circle',
							'options' => array(
								'circle'        => 'Circle',
								'dashes'        => 'Dashes',
								'dashes-spaced' => 'Dashes (Spaced)',
								'simple'        => 'Simple',
								'square'        => 'Square',
							),
						),
					),
				),
				'slide_options'  => array(
					'type'    => 'group',
					'heading' => __( 'Auto Slide' ),
					'options' => array(
						'auto_slide'  => array(
							'type'    => 'radio-buttons',
							'heading' => __( 'Auto slide' ),
							'default' => 'true',
							'options' => array(
								'false' => array( 'title' => 'Off' ),
								'true'  => array( 'title' => 'On' ),
							),
						),
						'timer'       => array(
							'type'    => 'textfield',
							'heading' => __( 'Timer (ms)' ),
							'default' => 6000,
						),
						'pause_hover' => array(
							'type'    => 'radio-buttons',
							'heading' => __( 'Pause on Hover' ),
							'default' => 'true',
							'options' => array(
								'false' => array( 'title' => 'Off' ),
								'true'  => array( 'title' => 'On' ),
							),
						),
					),
				),
				'layout_options' => array(
					'type'    => 'group',
					'heading' => __( 'Layout' ),
					'options' => array(
						'style'      => array(
							'type'    => 'select',
							'heading' => __( 'Style' ),
							'default' => 'normal',
							'options' => array(
								'normal'    => 'Default',
								'container' => 'Container',
								'focus'     => 'Focus',
								'shadow'    => 'Shadow',
							),
						),
						'infinitive' => array(
							'type'    => 'radio-buttons',
							'heading' => __( 'Infinitive' ),
							'default' => 'true',
							'options' => array(
								'false' => array( 'title' => 'Off' ),
								'true'  => array( 'title' => 'On' ),
							),
						),
						'draggable'  => array(
							'type'    => 'radio-buttons',
							'heading' => __( 'Draggable' ),
							'default' => 'true',
							'options' => array(
								'false' => array( 'title' => 'Off' ),
								'true'  => array( 'title' => 'On' ),
							),
						),
					),
				),
				'advanced_options' => array(
					'type'    => 'group',
					'heading' => __( 'Nâng cao', 'vn-story-card' ),
					'options' => array(
						'class' => array(
							'type'    => 'textfield',
							'heading' => __( 'Class', 'vn-story-card' ),
							'default' => '',
						),
					),
				),
			),
		)
	);
}

add_action( 'ux_builder_setup', 'vnsc_builder_slider' );

/**
 * Override UX Builder post search to be case-insensitive.
 *
 * Flatsome's built-in `ux_builder_post_search` filter (priority 500) builds a
 * raw LIKE clause that may be case-sensitive depending on the database collation.
 * This filter runs at priority 600 (after Flatsome's) and replaces the WHERE
 * clause with a LOWER()-wrapped version so searches work regardless of whether
 * the user types in uppercase or lowercase.
 *
 * @since 1.2.0
 * @param string   $search   The SQL WHERE search clause built by WordPress/Flatsome.
 * @param WP_Query $wp_query The current WP_Query instance.
 * @return string Modified search clause with case-insensitive LIKE.
 */
function vnsc_case_insensitive_post_search( $search, $wp_query ) {
	global $wpdb;

	// Only intercept UX Builder post-select AJAX calls.
	if (
		empty( $_GET['action'] ) ||
		'ux_builder_search_posts' !== $_GET['action'] // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	) {
		return $search;
	}

	$q = $wp_query->query_vars;

	if ( empty( $q['search_terms'] ) ) {
		return $search;
	}

	$n          = ! empty( $q['exact'] ) ? '' : '%';
	$search_sql = '';
	$searchand  = '';

	foreach ( (array) $q['search_terms'] as $term ) {
		// Dùng chuỗi gốc cho trường hợp nhập chính xác.
		$term_exact = $wpdb->esc_like( $term );
		// Normalise the term to lowercase for a case-insensitive match fallback.
		$term_lower = $wpdb->esc_like( mb_strtolower( $term, 'UTF-8' ) );

		$search_sql .= $wpdb->prepare(
			"{$searchand}( ({$wpdb->posts}.post_title LIKE %s) OR (LOWER({$wpdb->posts}.post_title) LIKE %s) )",
			"{$n}{$term_exact}{$n}",
			"{$n}{$term_lower}{$n}"
		);
		$searchand   = ' AND ';
	}

	if ( ! empty( $search_sql ) ) {
		$search = " AND ({$search_sql}) ";

		if ( ! is_user_logged_in() ) {
			$search .= " AND ({$wpdb->posts}.post_password = '') ";
		}
	}

	return $search;
}

add_filter( 'posts_search', 'vnsc_case_insensitive_post_search', 600, 2 );

/**
 * Load and return a template file from the plugin's templates directory.
 *
 * @since 1.0.0
 * @param string $path The path to the template file within the templates directory.
 * @return string The template content.
 */
function vnsc_builder_template( $path ) {
	ob_start();
	include VNSC_PATH . 'inc/templates/' . $path;
	return ob_get_clean();
}
