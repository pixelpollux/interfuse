<?php

/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function twentig_register_compat_block_styles() {

	register_block_style(
		'core/cover',
		array(
			'name'  => 'rounded',
			'label' => esc_html__( 'Rounded', 'twentig' ),
		)
	);

	register_block_style(
		'core/cover',
		array(
			'name'  => 'tw-rounded-corners',
			'label' => esc_html__( 'Small rounded', 'twentig' ),
		)
	);

	register_block_style(
		'core/cover',
		array(
			'name'  => 'tw-border-inner',
			'label' => esc_html__( 'Inner border', 'twentig' ),
		)
	);

	register_block_style(
		'core/cover',
		array(
			'name'  => 'tw-shadow',
			'label' => esc_html__( 'Shadow', 'twentig' ),
		)
	);

	register_block_style(
		'core/cover',
		array(
			'name'  => 'tw-hard-shadow',
			'label' => esc_html__( 'Hard shadow', 'twentig' ),
		)
	);

	register_block_style(
		'core/image',
		array(
			'name'  => 'tw-rounded-corners',
			'label' => esc_html__( 'Small rounded', 'twentig' ),
		)
	);

	register_block_style(
		'core/image',
		array(
			'name'  => 'tw-shadow',
			'label' => esc_html__( 'Shadow', 'twentig' ),
		)
	);

	register_block_style(
		'core/image',
		array(
			'name'  => 'tw-hard-shadow',
			'label' => esc_html__( 'Hard shadow', 'twentig' ),
		)
	);

	register_block_style(
		'core/image',
		array(
			'name'  => 'tw-frame',
			'label' => esc_html__( 'White frame', 'twentig' ),
		)
	);

	register_block_style(
		'core/image',
		array(
			'name'  => 'tw-border',
			'label' => esc_html__( 'Subtle border', 'twentig' ),
		)
	);

	register_block_style(
		'core/post-featured-image',
		array(
			'name'  => 'rounded',
			'label' => esc_html__( 'Rounded', 'twentig' ),
		)
	);

	register_block_style(
		'core/post-featured-image',
		array(
			'name'  => 'tw-rounded-corners',
			'label' => esc_html__( 'Small rounded', 'twentig' ),
		)
	);

	register_block_style(
		'core/post-featured-image',
		array(
			'name'  => 'tw-shadow',
			'label' => esc_html__( 'Shadow', 'twentig' ),
		)
	);

	register_block_style(
		'core/post-featured-image',
		array(
			'name'  => 'tw-hard-shadow',
			'label' => esc_html__( 'Hard shadow', 'twentig' ),
		)
	);

	register_block_style(
		'core/post-featured-image',
		array(
			'name'  => 'tw-frame',
			'label' => esc_html__( 'White frame', 'twentig' ),
		)
	);

	register_block_style(
		'core/post-featured-image',
		array(
			'name'  => 'tw-border',
			'label' => esc_html__( 'Subtle Border', 'twentig' ),
		)
	);

	register_block_style(
		'core/gallery',
		array(
			'name'  => 'tw-img-rounded',
			'label' => esc_html__( 'Small rounded', 'twentig' ),
		)
	);

	register_block_style(
		'core/gallery',
		array(
			'name'  => 'tw-img-frame',
			'label' => esc_html__( 'White frame', 'twentig' ),
		)
	);

	register_block_style(
		'core/latest-posts',
		array(
			'name'  => 'tw-posts-card',
			'label' => esc_html__( 'Card', 'twentig' ),
		)
	);

	register_block_style(
		'core/latest-posts',
		array(
			'name'  => 'tw-posts-border',
			'label' => esc_html__( 'Border', 'twentig' ),
		)
	);

	register_block_style(
		'core/pullquote',
		array(
			'name'  => 'plain',
			'label' => esc_html_x( 'Plain', 'block style', 'twentig' ),
		)
	);
	
	if ( wp_is_block_theme() ) {	
		unregister_block_style( 'core/gallery', 'tw-img-frame' );
		
		if ( 'twentytwentyfour' === get_template() ) {
			unregister_block_style( 'core/pullquote', 'plain' );
			unregister_block_style( 'core/post-featured-image', 'rounded' );
			unregister_block_style( 'core/post-featured-image', 'tw-rounded-corners' );
			unregister_block_style( 'core/post-featured-image', 'tw-border' );
		}
	} else {
		unregister_block_style( 'core/search', 'tw-underline' );
		unregister_block_style( 'core/pullquote', 'plain' );
		unregister_block_style( 'core/post-navigation-link', 'tw-nav-stack' );
		unregister_block_style( 'core/query-pagination-numbers', 'tw-square' );
		unregister_block_style( 'core/query-pagination-numbers', 'tw-rounded' );
		unregister_block_style( 'core/query-pagination-numbers', 'tw-circle' );
		unregister_block_style( 'core/query-pagination-numbers', 'tw-plain' );
		unregister_block_style( 'core/query-pagination-previous', 'tw-btn-square' );
		unregister_block_style( 'core/query-pagination-previous', 'tw-btn-rounded' );
		unregister_block_style( 'core/query-pagination-previous', 'tw-btn-pill' );
		unregister_block_style( 'core/query-pagination-next', 'tw-btn-square' );
		unregister_block_style( 'core/query-pagination-next', 'tw-btn-rounded' );
		unregister_block_style( 'core/query-pagination-next', 'tw-btn-pill' );
	}
}
add_action( 'init', 'twentig_register_compat_block_styles', 11 );
