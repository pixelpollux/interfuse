<?php
/**
 * Functionalities for Twenty Twenty-Three.
 *
 * @package twentig
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hooks into the data provided by the theme to change settings.
 */
function twentig_twentythree_filter_theme_json( $theme_json ) {
	if ( twentig_theme_supports_spacing() ) {
		$new_data = array(
			'version' => 2,
			'styles'  => array(
				'blocks' => array(
					'core/columns' => array(
						'spacing' => array(
							'blockGap' => '48px 32px'
						)
					)
				)
			),
		);
		return $theme_json->update_with( $new_data );
	}
	return $theme_json;
	
}
add_filter( 'wp_theme_json_data_theme', 'twentig_twentythree_filter_theme_json' );

/**
 * Enqueue styles for the theme.
 */
function twentig_twentythree_enqueue_scripts() {

	if ( ! twentig_theme_supports_spacing() ) {
		return;
	}

	$css = '
	:where(.wp-block-post-content) .wp-block-group.alignfull:not(.has-background) {
		margin-block: var(--wp--custom--spacing--tw-x-large);
	}

	:where(.wp-block-post-content) .alignwide:where(.wp-block-cover,.wp-block-group,.wp-block-media-text),
	:where(.wp-block-post-content) .alignwide:where(.wp-block-cover,.wp-block-group,.wp-block-media-text) + * {
		margin-top: var(--wp--custom--spacing--tw-medium);
	}

	.wp-site-blocks .wp-block-spacer.wp-block-spacer,
	.wp-site-blocks .wp-block-spacer.wp-block-spacer + *,
	.wp-block-post-content > :is(*,.wp-block-group):first-child {
		margin-top: 0;
	}
		
	.wp-block-post-content .wp-block-group.alignfull:last-child {
		margin-bottom: 0;
	}';

	wp_add_inline_style( 'twentig-global-spacing', twentig_minify_css( $css ) );
}
add_action( 'wp_enqueue_scripts', 'twentig_twentythree_enqueue_scripts', 12 );
