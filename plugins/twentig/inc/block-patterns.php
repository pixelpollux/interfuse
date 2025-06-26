<?php
/**
 * Block Patterns
 *
 * @package twentig
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the block pattern categories.
 */
function twentig_register_block_pattern_categories() {
	register_block_pattern_category( 'posts', array( 'label' => _x( 'Posts', 'Block pattern category' ) ) );
	register_block_pattern_category( 'text', array( 'label' => esc_html_x( 'Text', 'Block pattern category' ) ) );
	register_block_pattern_category( 'text-image', array( 'label' => esc_html_x( 'Text and Image', 'Block pattern category', 'twentig' ) ) );
	register_block_pattern_category( 'hero', array( 'label' => esc_html_x( 'Hero', 'Block pattern category', 'twentig' ) ) );
	register_block_pattern_category( 'banner', array( 'label' => esc_html_x( 'Banners', 'Block pattern category' ) ) );
	register_block_pattern_category( 'call-to-action', array( 'label' => esc_html_x( 'Call to Action', 'Block pattern category' ) ) );
	register_block_pattern_category( 'list', array( 'label' => esc_html_x( 'List', 'Block pattern category', 'twentig' ) ) );
	register_block_pattern_category( 'numbers', array( 'label' => esc_html_x( 'Numbers, Stats', 'Block pattern category', 'twentig' ) ) );
	register_block_pattern_category( 'gallery', array( 'label' => esc_html_x( 'Gallery', 'Block pattern category' ) ) );
	register_block_pattern_category( 'media', array( 'label' => esc_html_x( 'Media', 'Block pattern category' ) ) );
	register_block_pattern_category( 'latest-posts', array( 'label' => esc_html_x( 'Latest Posts', 'Block pattern category', 'twentig' ) ) );
	register_block_pattern_category( 'contact', array( 'label' => esc_html_x( 'Contact', 'Block pattern category' ) ) );
	register_block_pattern_category( 'team', array( 'label' => esc_html_x( 'Team', 'Block pattern category' ) ) );
	register_block_pattern_category( 'testimonials', array( 'label' => esc_html_x( 'Testimonials', 'Block pattern category' ) ) );
	register_block_pattern_category( 'logos', array( 'label' => esc_html_x( 'Logos, Clients', 'Block pattern category', 'twentig' ) ) );
	register_block_pattern_category( 'pricing', array( 'label' => esc_html_x( 'Pricing', 'Block pattern category', 'twentig' ) ) );
	register_block_pattern_category( 'faq', array( 'label' => esc_html_x( 'FAQs', 'Block pattern category', 'twentig' ) ) );
	register_block_pattern_category( 'events', array( 'label' => esc_html_x( 'Events, Schedule', 'Block pattern category', 'twentig' ) ) );
	register_block_pattern_category( 'page', array( 'label' => _x( 'Pages', 'Block pattern category' ) ) );
	register_block_pattern_category( 'page-single', array( 'label' => _x( 'Single Pages', 'Block pattern category', 'twentig' ) ) );
}
add_action( 'init', 'twentig_register_block_pattern_categories', 9 );

/**
 * Registers the block patterns.
 */
function twentig_register_block_patterns() {

	if ( ! twentig_is_option_enabled( 'patterns' ) ) {
		return;
	}

	$path = TWENTIG_PATH . 'inc/patterns/';
	
	if ( ! wp_is_block_theme() ) {
		$path = TWENTIG_PATH . 'inc/classic/patterns/';
	}

	$files = array(
		'columns.php',
		'text.php',
		'contact.php',
		'text-image.php',
		'banner.php',
		'call-to-action.php',
		'events.php',
		'faq.php',
		'gallery.php',
		'hero.php',
		'latest-posts.php',
		'list.php',
		'logos.php',
		'numbers.php',
		'pricing.php',
		'team.php',
		'testimonials.php',
		'media.php',
		'pages.php',
		'single-page.php',
		'header.php',
		'footer.php',
		'posts.php',
		'portfolio.php',
	);

	if ( 'twentytwenty' === get_template() ) {
		$files[] = 'twentytwenty.php';
	}

	foreach ( $files as $file ) {
		if ( file_exists( $path . $file ) ) {
			require_once $path . $file;
		}
	}
}
add_action( 'init', 'twentig_register_block_patterns' );

/**
 * Registers a block pattern.
 *
 * @param string $pattern_name       Pattern name including namespace.
 * @param array  $pattern_properties Array containing the properties of the pattern.
 */
function twentig_register_block_pattern( $pattern_name, $pattern_properties ) {

	static $theme         = null;
	static $block_theme   = null;
	static $twentig_theme = null;
	static $twentig_v2    = null;

	
	if ( ! isset( $pattern_properties['viewportWidth'] ) ) {
		$pattern_properties['viewportWidth'] = 1366;
	}

	if ( is_null( $twentig_theme ) ) {
		$twentig_theme = current_theme_supports( 'twentig-theme' );
	}	

	if ( $twentig_theme ) {
		register_block_pattern(
			$pattern_name,
			$pattern_properties
		);
		return;
	}

	if ( is_null( $theme ) ) {
		$theme = get_template();
	}

	if ( is_null( $block_theme ) ) {
		$block_theme = wp_is_block_theme();
	}

	if ( is_null( $twentig_v2 ) ) {
		$twentig_v2 = current_theme_supports( 'twentig-v2' );
	}
	
	if ( ! $twentig_v2 && $block_theme ) {
		$pattern_properties['content'] = twentig_replace_pattern_preset_to_values( $pattern_properties['content'] );
	}
	
	$pattern_properties['content'] = twentig_replace_theme_patterns_strings( $pattern_properties['content'], $theme );

	register_block_pattern(
		$pattern_name,
		$pattern_properties
	);
}

/**
 * Replaces pattern styles for non Twentig theme.
 */
function twentig_replace_theme_patterns_strings( $content, $theme ) {

	switch( $theme ) {
		case 'twentytwentyfive':

			$colors = array(
				'base-2'    => 'accent-5',
				'secondary' => 'contrast',
				'tertiary'  => 'accent-6',
			);

			$font_sizes = array(
				'4-x-large' => 'xx-large',
				'3-x-large' => 'x-large',
				'xx-large'  => 'x-large',
				'medium'    => 'large',
				'normal'    => 'medium',
				'x-small'   => 'small'
			);

			$spacing_sizes = array(
				'65'   => '60',
				'60'   => '50',
				'55'   => '60',
				'45'   => '50',
				'40'   => '50',
				'35'   => '40',
				'30'   => '40',
				'25'   => '40',
				'20'   => '30',
				'15'   => '16px',
				'10'   => '20',
				'5'    => '4px',
			);

			$content = twentig_replace_pattern_color_values( $colors, $content );
			$content = twentig_replace_pattern_font_size_values( $font_sizes, $content );
			$content = twentig_replace_pattern_spacing_size_values( $spacing_sizes, $content );

			break;
		case 'twentytwentythree':
			$colors = array(
				'base-2'    => 'tertiary',
				'secondary' => 'contrast',
			);
			$content = twentig_replace_pattern_color_values( $colors, $content );
			
			break;
		case 'twentytwentytwo':
			$colors = array(
				'base'      => 'background',
				'contrast'  => 'foreground',
				'base-2'    => 'tertiary',
				'secondary' => 'foreground',
			);
			$content = twentig_replace_pattern_color_values( $colors, $content );

			break;
		case 'twentytwenty':
			$colors = array(
				'subtle' => 'subtle-background',
			);

			$content = twentig_replace_pattern_color_values( $colors, $content );

			$font_sizes = array(
				'large'       => 'h5',
				'medium'      => 'large',
				'h3'          => 'h4',
				'extra-large' => 'h3',
				'huge'	      => 'h1',
			);

			foreach ( $font_sizes as $old_size => $new_size ) {
				$content = str_replace( "\"fontSize\":\"$old_size\"", "\"fontSize\":\"$new_size\"", $content );
				$formatted_old_size = preg_replace('/([a-zA-Z])(\d)/', '$1-$2', $old_size);
				$formatted_new_size = preg_replace('/([a-zA-Z])(\d)/', '$1-$2', $new_size);
				$content = str_replace("has-$formatted_old_size-font-size", "has-$formatted_new_size-font-size", $content);
			}
			break;
	}

	return $content;
}

/**
 * Replaces color preset values.
 */
function twentig_replace_pattern_color_values( $colors, $content ) {
	foreach ( $colors as $old_color => $new_color ) {
		$content = str_replace( "\"textColor\":\"$old_color\"", "\"textColor\":\"$new_color\"", $content );
		$content = str_replace( "\"backgroundColor\":\"$old_color\"", "\"backgroundColor\":\"$new_color\"", $content );
		$content = str_replace( "\"borderColor\":\"$old_color\"", "\"borderColor\":\"$new_color\"", $content );
		$content = str_replace( "\"iconColor\":\"$old_color\"", "\"iconColor\":\"$new_color\"", $content );
		$content = str_replace( "\"iconColorValue\":\"var(--wp--preset--color--$old_color)\"", "\"iconColorValue\":\"var(--wp--preset--color--$new_color)\"", $content );
		$content = str_replace( "has-$old_color-color", "has-$new_color-color", $content );
		$content = str_replace( "has-$old_color-background-color", "has-$new_color-background-color", $content );
		$content = str_replace( "has-$old_color-border-color", "has-$new_color-border-color", $content );
	}
	return $content;	
}

/**
 * Replaces font size preset values.
 */
function twentig_replace_pattern_font_size_values( $font_sizes, $content ) {
	foreach ( $font_sizes as $old_size => $new_size ) { // Replace using a temporary wrapper to avoid re-replacement
		$content = str_replace( "\"fontSize\":\"$old_size\"", "\"fontSize\":\"TEMP_$new_size\"", $content );
		$content = str_replace( "has-$old_size-font-size", "has-TEMP_$new_size-font-size", $content );
	}
	foreach ( $font_sizes as $old_size => $new_size ) { // Replace all temporary placeholders with the actual new values
		$content = str_replace( "\"fontSize\":\"TEMP_$new_size\"", "\"fontSize\":\"$new_size\"", $content );
		$content = str_replace( "has-TEMP_$new_size-font-size", "has-$new_size-font-size", $content );
	}	
	return $content;
}

/**
 * Replaces spacing preset values.
 */
function twentig_replace_pattern_spacing_size_values( $spacing_sizes, $content ) {

	foreach ( $spacing_sizes as $old_size => $new_value ) {
		if ( str_contains( $new_value, 'px' ) ) {
			$content = str_replace( "\"var:preset|spacing|$old_size\"", "\"$new_value\"", $content ); 
			$content = str_replace( "var(--wp--preset--spacing--$old_size)", $new_value, $content );
		} else {
			$content = str_replace( "\"var:preset|spacing|$old_size\"", "\"var:preset|spacing|TEMP_$new_value\"", $content );
			$content = str_replace( "var(--wp--preset--spacing--$old_size)", "var(--wp--preset--spacing--TEMP_$new_value)", $content );
		}
	}			
	foreach ( $spacing_sizes as $old_size => $new_value ) {
		if ( ! str_contains( $new_value, 'px' ) ) {
			$content = str_replace( "\"var:preset|spacing|TEMP_$new_value\"", "\"var:preset|spacing|$new_value\"", $content );
			$content = str_replace( "var(--wp--preset--spacing--TEMP_$new_value)", "var(--wp--preset--spacing--$new_value)", $content );
		}
	}	

	return $content;
}

/**
 * Replaces theme preset by values.
 */
function twentig_replace_pattern_preset_to_values( $content ) {

	$strings_replace = array(
		array(
			'old' => ',"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}}',
			'new' => '',
		),
		array(
			'old' => ',"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap"',
			'new' => ',"style":{"spacing":{"blockGap"',
		),
		array(
			'old' => ' style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"',
			'new' => '',
		),
		array(
			'old' => '<!-- wp:paragraph {"fontSize":"large","align":"center","style":{"typography":{"lineHeight":"1.35"}}} --><p class="has-text-align-center has-large-font-size" style="line-height:1.35">',
			'new' => '<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.35","fontSize":"1.25em"}}} --><p class="has-text-align-center" style="font-size:1.25em;line-height:1.35">',
		),
		array(
			'old' => '<!-- wp:paragraph {"fontSize":"large","style":{"typography":{"lineHeight":"1.35"}}} --><p class="has-large-font-size" style="line-height:1.35">',
			'new' => '<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.35","fontSize":"1.25em"}}} --><p style="font-size:1.25em;line-height:1.35">',
		),
		array(
			'old' => '<!-- wp:paragraph {"fontSize":"large","align":"center","style":{"typography":{"lineHeight":"1.35"},"spacing":{"margin"',
			'new' => '<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25em","lineHeight":"1.35"},"spacing":{"margin"',
		),
		array(
			'old' => '<p class="has-text-align-center has-large-font-size" style="line-height:1.35;margin',
			'new' => '<p class="has-text-align-center" style="font-size:1.25em;line-height:1.35;margin',
		),		
		array(
			'old' => '<!-- wp:paragraph {"align":"center","fontSize":"medium"} --><p class="has-text-align-center has-medium-font-size">',
			'new' => '<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">',
		),	
		array(
			'old' => '<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} --><h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--60)">',
			'new' => '<!-- wp:heading {"textAlign":"center"} --><h2 class="wp-block-heading has-text-align-center">',
		),
		array(
			'old' => '<!-- wp:heading {"level":3,"fontSize":"large"} --><h3 class="wp-block-heading has-large-font-size">',
			'new' => '<!-- wp:heading {"level":3} --><h3 class="wp-block-heading">',
		),
		array(
			'old' => '<!-- wp:heading {"level":3,"fontSize":"large","textAlign":"center"} --><h3 class="has-large-font-size has-text-align-center">',
			'new' => '<!-- wp:heading {"level":3,"textAlign":"center"} --><h3 class="wp-block-heading has-text-align-center">',
		),
		array(
			'old' => '<!-- wp:heading {"level":3,"fontSize":"medium"} --><h3 class="wp-block-heading has-medium-font-size">',
			'new' => '<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.25em"}}} --><h3 class="wp-block-heading" style="font-size:1.25em">',
		),
		array(
			'old' => '<!-- wp:heading {"level":3,"fontSize":"medium","textAlign":"center"} --><h3 class="wp-block-heading has-medium-font-size has-text-align-center">',
			'new' => '<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"1.25em"}}} --><h3 class="wp-block-heading has-text-align-center" style="font-size:1.25em">',
		),
		array(
			'old' => '<!-- wp:heading {"level":3,"fontSize":"medium","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} --><h3 class="wp-block-heading has-medium-font-size" style="margin-top:var(--wp--preset--spacing--30)">',
			'new' => '<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"32px"}},"typography":{"fontSize":"1.25em"}}} --><h3 class="wp-block-heading" style="margin-top:32px;font-size:1.25em">',
		),		
		array(
			'old' => '<!-- wp:separator {',
			'new' => '<!-- wp:separator {"className":"is-style-wide",'
		),
		array(
			'old' => '<hr class="wp-block-separator ',
			'new' => '<hr class="wp-block-separator is-style-wide '
		),	
	);
	
	$content = twentig_replace_pattern_array_strings( $content, $strings_replace );

	$font_sizes = array(
		'4-x-large' => 'xx-large',
		'3-x-large' => 'xx-large',
		'xx-large'  => 'x-large',
		'x-small'   => 'small'
	);

	$content = twentig_replace_pattern_font_size_values( $font_sizes, $content );

	$spacing_sizes = array(
		'65'   => '64px',
		'60'   => '64px',
		'55'   => '48px',
		'50'   => '48px',
		'45'   => '48px',
		'40'   => '40px',
		'35'   => '32px',
		'30'   => '32px',
		'25'   => '32px',
		'20'   => '24px',
		'15'   => '16px',
		'10'   => '8px',
		'5'    => '4px',
	);

	foreach ( $spacing_sizes as $size => $value ) {
		$content = str_replace( "var:preset|spacing|$size", $value, $content );
		$content = str_replace( "var(--wp--preset--spacing--$size)", $value, $content );
	}

	return $content;
}

/**
 * Performs a batch string replacement in the specified content.
 * 
 * @param string  $content The original content.
 * @param array   $replacements Array of arrays with 'old' and 'new' string pairs for replacement.
 * @return string Content with all occurrences of 'old' strings replaced by 'new' strings.
 */
function twentig_replace_pattern_array_strings( $content, $replacements ) {
	$old_strings = array_column( $replacements, 'old' );
	$new_strings = array_column( $replacements, 'new' );

	return str_replace( $old_strings, $new_strings, $content );
}

/**
 * Retrieves the url of asset stored inside the plugin that can be used in block patterns.
 *
 * @param string $asset_name Asset name.
 */
function twentig_get_pattern_asset( $asset_name ) {
	return esc_url( TWENTIG_ASSETS_URI . '/images/patterns/' . $asset_name );
}
