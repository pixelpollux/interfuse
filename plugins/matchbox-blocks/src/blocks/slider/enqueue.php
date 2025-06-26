<?php
/**
 * Enqueue styles for the slider block
 *
 * @package MatchboxBlocks
 * @since 1.0.0
 */
function matchbox_enqueue_slider_styles() {
	// Enqueue Splide styles.
	wp_enqueue_style(
		'splide-core',
		plugins_url( 'slider/splide/splide-core.min.css', __DIR__ ),
		[],
		'4.1.4'
	);
	wp_enqueue_style(
		'splide-theme',
		plugins_url( 'slider/splide/splide-sea-green.min.css', __DIR__ ),
		[ 'splide-core' ],
		'4.1.4'
	);

	// Enqueue custom slider styles.
	wp_enqueue_style(
		'matchbox-slider-styles',
		plugins_url( 'build/blocks/slider/view.css', dirname( dirname( __DIR__ ) ) ),
		[ 'splide-core', 'splide-theme' ],
		filemtime( plugin_dir_path( dirname( dirname( __DIR__ ) ) ) . 'build/blocks/slider/view.css' )
	);
}
add_action( 'wp_enqueue_scripts', 'matchbox_enqueue_slider_styles' );
add_action( 'enqueue_block_editor_assets', 'matchbox_enqueue_slider_styles' );
