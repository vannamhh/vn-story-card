<?php
/**
 * VN Story Card Shortcode
 *
 * @package vn-story-card
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VN Story Card Shortcode Class
 *
 * Handles the rendering of the story card shortcode.
 *
 * @since 1.0.0
 */
class VN_Story_Card_Shortcode {

	/**
	 * Initialize the shortcode.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_shortcode( 'vn_story_card', array( $this, 'render_shortcode' ) );
	}

	/**
	 * Get default attributes for the shortcode.
	 *
	 * @since 1.0.0
	 * @return array Default attributes.
	 */
	private function get_default_atts() {
		return array(
			'_id'         => 'story-card-' . wp_rand(),
			'post_id'     => '',
			'title'       => '',
			'button_text' => 'Nội dung câu chuyện',
			'link'        => '',
			'target'      => '',
			'image'       => '',
			'class'       => '',
			'visibility'  => '',
		);
	}

	/**
	 * Resolve post data based on post_id and user overrides.
	 *
	 * Priority logic:
	 * - Title: custom title > post title
	 * - Link: custom link > post permalink
	 * - Image: custom image > post featured image
	 *
	 * @since 1.0.0
	 * @param array $atts Shortcode attributes.
	 * @return array Resolved data with 'title', 'link', 'image_id' keys.
	 */
	private function resolve_post_data( $atts ) {
		$resolved = array(
			'title'    => $atts['title'],
			'link'     => $atts['link'],
			'image_id' => $atts['image'] ? absint( $atts['image'] ) : 0,
		);

		$post_id = $atts['post_id'] ? absint( $atts['post_id'] ) : 0;

		if ( $post_id ) {
			$post = get_post( $post_id );

			if ( $post && 'publish' === $post->post_status ) {
				// Title: custom > post title.
				if ( empty( $resolved['title'] ) ) {
					$resolved['title'] = get_the_title( $post );
				}

				// Link: custom > post permalink.
				if ( empty( $resolved['link'] ) ) {
					$resolved['link'] = get_permalink( $post );
				}

				// Image: custom > featured image.
				if ( ! $resolved['image_id'] && has_post_thumbnail( $post ) ) {
					$resolved['image_id'] = get_post_thumbnail_id( $post );
				}
			}
		}

		return $resolved;
	}

	/**
	 * Render the shortcode.
	 *
	 * @since 1.0.0
	 * @param array  $atts    Shortcode attributes.
	 * @param string $content Shortcode content (unused).
	 * @return string HTML output.
	 */
	public function render_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts( $this->get_default_atts(), $atts );

		// Stop if visibility is hidden.
		if ( 'hidden' === $atts['visibility'] ) {
			return '';
		}

		$data = $this->resolve_post_data( $atts );

		// Nothing to display without a title.
		if ( empty( $data['title'] ) ) {
			return '';
		}

		$title       = wp_kses_post( $data['title'] );
		$link        = $data['link'] ? esc_url( $data['link'] ) : '#';
		$image_id    = $data['image_id'] ? absint( $data['image_id'] ) : '';
		$button_text = $atts['button_text'] ? esc_attr( $atts['button_text'] ) : esc_attr__( 'Nội dung câu chuyện', 'vn-story-card' );
		$target      = $atts['target'] ? esc_attr( $atts['target'] ) : '';

		// Build button shortcode.
		$button_shortcode = sprintf(
			'[button text="%s" radius="99" link="%s"',
			$button_text,
			$link
		);
		if ( $target ) {
			$button_shortcode .= sprintf( ' target="%s"', $target );
		}
		$button_shortcode .= ']';

		// Build image shortcode.
		$image_shortcode = '';
		if ( $image_id ) {
			$image_shortcode = sprintf(
				'[ux_image id="%d" image_size="medium_large" height="71.89%%" link="%s"]',
				$image_id,
				$link
			);
		}

		// Build the full template using Flatsome shortcodes.
		$output = sprintf(
			'[row_inner class="%1$s"]
[col_inner span="6" span__sm="12" class="pb-0"]
[ux_text class="is-xxlarge leading-125 mb"]
<p>%2$s</p>
[/ux_text]
%3$s
[gap height="4rem" height__sm="4rem"]
[/col_inner]
[col_inner span="6" span__sm="12" class="pb-0"]
%4$s
[/col_inner]
[/row_inner]',
			esc_attr( trim( $atts['visibility'] . ' ' . $atts['class'] ) ),
			$title,
			$button_shortcode,
			$image_shortcode
		);

		return do_shortcode( $output );
	}
}

// Initialize shortcode.
new VN_Story_Card_Shortcode();
