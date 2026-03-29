<?php
/**
 * VN Story Cards Shortcode (Slider Container)
 *
 * Wraps multiple [vn_story_card] items in a Flatsome Flickity slider.
 *
 * @package vn-story-card
 * @since 1.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VN Story Cards Shortcode Class (Slider Wrapper)
 *
 * @since 1.1.0
 */
class VN_Story_Cards_Shortcode {

	/**
	 * Initialize the shortcode.
	 *
	 * @since 1.1.0
	 */
	public function __construct() {
		add_shortcode( 'vn_story_cards', array( $this, 'render_shortcode' ) );
	}

	/**
	 * Get default attributes.
	 *
	 * Mirrors the ux_slider parameter set so existing shortcode strings
	 * are fully compatible.
	 *
	 * @since 1.1.0
	 * @return array Default attributes.
	 */
	private function get_default_atts() {
		return array(
			'_id'                => 'story-slider-' . wp_rand(),
			// Navigation.
			'hide_nav'           => '',
			'nav_pos'            => '',
			'nav_style'          => 'circle',
			'nav_color'          => 'light',
			'nav_size'           => 'large',
			'arrows'             => 'true',
			// Bullets.
			'bullets'            => 'true',
			'bullet_style'       => 'circle',
			// Auto-slide.
			'auto_slide'         => 'true',
			'timer'              => '6000',
			'pause_hover'        => 'true',
			// Layout / Flickity.
			'type'               => 'slide',
			'style'              => 'normal',
			'slide_align'        => 'center',
			'slide_width'        => '',
			'infinitive'         => 'true',
			'freescroll'         => 'false',
			'draggable'          => 'true',
			'parallax'           => '0',
			'friction'           => '0.6',
			'selectedattraction' => '0.1',
			'threshold'          => '10',
			'auto_height'        => 'true',
			'bg_color'           => '',
			'margin'             => '',
			// Visibility / extra class.
			'class'              => '',
			'visibility'         => '',
		);
	}

	/**
	 * Render the shortcode.
	 *
	 * Outputs a Flickity-compatible slider wrapper identical in markup to
	 * [ux_slider], so Flatsome's existing JS/CSS applies without modification.
	 *
	 * @since 1.1.0
	 * @param array  $atts    Shortcode attributes.
	 * @param string $content Child [vn_story_card] shortcodes as raw text.
	 * @return string HTML output.
	 */
	public function render_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts( $this->get_default_atts(), $atts );

		// Stop if visibility is set to hidden.
		if ( 'hidden' === $atts['visibility'] ) {
			return '';
		}

		$slider_id = esc_attr( $atts['_id'] );

		// Convert auto_slide flag → timer value (same as ux_slider).
		$auto_slide = ( 'true' === $atts['auto_slide'] ) ? esc_attr( $atts['timer'] ) : 'false';

		// RTL support.
		$rtl = is_rtl() ? 'true' : 'false';

		// Arrow/bullet booleans.
		$is_arrows  = ( 'false' === $atts['arrows'] ) ? 'false' : 'true';
		$is_bullets = ( 'false' === $atts['bullets'] ) ? 'false' : 'true';

		// Pre-escape Flickity JSON values.
		$cell_align          = esc_attr( $atts['slide_align'] );
		$freescroll          = esc_attr( $atts['freescroll'] );
		$infinitive          = esc_attr( $atts['infinitive'] );
		$pause_hover         = esc_attr( $atts['pause_hover'] );
		$auto_height         = esc_attr( $atts['auto_height'] );
		$threshold           = esc_attr( $atts['threshold'] );
		$draggable           = esc_attr( $atts['draggable'] );
		$selectedattraction  = esc_attr( $atts['selectedattraction'] );
		$parallax            = esc_attr( $atts['parallax'] );
		$friction            = esc_attr( $atts['friction'] );

		// Build Flickity JSON data attribute.
		$flickity_options = sprintf(
			'{' .
			'"cellAlign":"%s",' .
			'"imagesLoaded":true,' .
			'"lazyLoad":1,' .
			'"freeScroll":%s,' .
			'"wrapAround":%s,' .
			'"autoPlay":%s,' .
			'"pauseAutoPlayOnHover":%s,' .
			'"prevNextButtons":%s,' .
			'"contain":true,' .
			'"adaptiveHeight":%s,' .
			'"dragThreshold":%s,' .
			'"percentPosition":true,' .
			'"pageDots":%s,' .
			'"rightToLeft":%s,' .
			'"draggable":%s,' .
			'"selectedAttraction":%s,' .
			'"parallax":%s,' .
			'"friction":%s' .
			'}',
			$cell_align,
			$freescroll,
			$infinitive,
			$auto_slide,
			$pause_hover,
			$is_arrows,
			$auto_height,
			$threshold,
			$is_bullets,
			$rtl,
			$draggable,
			$selectedattraction,
			$parallax,
			$friction
		);

		// Build slider inner CSS classes.
		$slider_classes = array( 'slider' );
		if ( 'fade' === $atts['type'] ) {
			$slider_classes[] = 'slider-type-fade';
		}
		if ( $atts['bullet_style'] ) {
			$slider_classes[] = 'slider-nav-dots-' . sanitize_html_class( $atts['bullet_style'] );
		}
		if ( $atts['nav_style'] ) {
			$slider_classes[] = 'slider-nav-' . sanitize_html_class( $atts['nav_style'] );
		}
		if ( $atts['nav_size'] ) {
			$slider_classes[] = 'slider-nav-' . sanitize_html_class( $atts['nav_size'] );
		}
		if ( $atts['nav_color'] ) {
			$slider_classes[] = 'slider-nav-' . sanitize_html_class( $atts['nav_color'] );
		}
		if ( $atts['nav_pos'] ) {
			$slider_classes[] = 'slider-nav-' . sanitize_html_class( $atts['nav_pos'] );
		}
		if ( $atts['style'] ) {
			$slider_classes[] = 'slider-style-' . sanitize_html_class( $atts['style'] );
		}
		if ( 'true' === $atts['hide_nav'] ) {
			$slider_classes[] = 'slider-show-nav';
		}
		$slider_class_str = implode( ' ', $slider_classes );

		// Build wrapper CSS classes.
		$wrapper_classes = array( 'slider-wrapper', 'relative' );
		if ( $atts['class'] ) {
			$wrapper_classes[] = esc_attr( $atts['class'] );
		}
		if ( $atts['visibility'] ) {
			$wrapper_classes[] = esc_attr( $atts['visibility'] );
		}
		$wrapper_class_str = implode( ' ', $wrapper_classes );

		// Inline background color.
		$inline_style = '';
		if ( $atts['bg_color'] ) {
			$inline_style = ' style="background-color:' . esc_attr( $atts['bg_color'] ) . '"';
		}

		// Render each [vn_story_card] wrapped in a .slide div.
		$slides_html = $this->wrap_cards_in_slides( $content );

		return sprintf(
			'<div class="%s" id="%s"%s><div class="%s" data-flickity-options=\'%s\'>%s</div><div class="loading-spin dark large centered"></div></div>',
			esc_attr( $wrapper_class_str ),
			$slider_id,
			$inline_style,
			esc_attr( $slider_class_str ),
			$flickity_options,
			$slides_html
		);
	}

	/**
	 * Wrap each [vn_story_card] shortcode in a .slide div cell.
	 *
	 * Each child shortcode output becomes one Flickity cell so the slider
	 * treats every story card as an independent slide.
	 *
	 * @since 1.1.0
	 * @param string $content Raw shortcode content containing [vn_story_card] tags.
	 * @return string HTML with each card wrapped in a .slide div.
	 */
	private function wrap_cards_in_slides( $content ) {
		if ( empty( $content ) ) {
			return '';
		}

		// Match every standalone [vn_story_card ...] shortcode.
		preg_match_all( '/\[vn_story_card[^\]]*\]/', $content, $matches );
		$tags = $matches[0];

		if ( empty( $tags ) ) {
			// Fallback: render content as-is if no tags found.
			return do_shortcode( $content );
		}

		$output = '';
		foreach ( $tags as $tag ) {
			$rendered = do_shortcode( $tag );
			if ( ! empty( $rendered ) ) {
				$output .= '<div class="slide">' . $rendered . '</div>';
			}
		}

		return $output;
	}
}

// Initialize.
new VN_Story_Cards_Shortcode();
