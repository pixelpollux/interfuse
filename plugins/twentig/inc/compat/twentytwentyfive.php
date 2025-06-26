<?php
/**
 * Functionalities for Twenty Twenty-Five.
 *
 * @package twentig
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds support for Twentig website templates.
 */
function twentig_twentyfive_theme_support() {

	$template_path = TWENTIG_PATH . 'dist/templates/';
	$template_uri  = TWENTIG_URI . 'dist/templates/';

	$website_templates = array(
		array(
			'title'      => __( 'Business', 'twentig' ),
			'screenshot' => esc_url( $template_uri . 'tt5-business.webp' ),
			'file'       => $template_path . 'tt5-business.xml',
			'url'        => 'https://demo.twentig.com/tt5-business/',
			'options'    => array(
				'front_page' => 'Home',
				'blog_page'  => 'Blog',
			),
		),
		array(
			'title'      => __( 'News Blog', 'twentig' ),
			'screenshot' => esc_url( $template_uri . 'tt5-news.webp' ),
			'file'       => $template_path . 'tt5-news.xml',
			'url'        => 'https://demo.twentig.com/tt5-news/',
			'options'    => array(
				'front_page' => 'Home',
				'blog_page'  => 'Blog',
			),
		),
		array(
			'title'      => __( 'Photo Blog', 'twentig' ),
			'screenshot' => esc_url( $template_uri . 'tt5-photo.webp' ),
			'file'       => $template_path . 'tt5-photo.xml',
			'url'        => 'https://demo.twentig.com/tt5-photo/',
			'options'    => array(
				'front_page'     => 'posts',
				'posts_per_page' => 12,
			),
		),
		array(
			'title'      => __( 'Personal Blog', 'twentig' ),
			'screenshot' => esc_url( $template_uri . 'tt5-personal.png' ),
			'file'       => $template_path . 'tt5-personal.xml',
			'url'        => 'https://demo.twentig.com/tt5-personal/',
			'options'    => array(
				'front_page' => 'posts',
			),
		)
	);
	add_theme_support( 'twentig-starter-website-templates', $website_templates );

	add_theme_support( 'twentig-v2' );
}
add_action( 'after_setup_theme', 'twentig_twentyfive_theme_support' );
