<?php
/**
 * Hero block patterns.
 *
 * @package twentig
 * @phpcs:disable Squiz.Strings.DoubleQuoteUsage.NotRequired
 */

$group_name = esc_html_x( 'Hero', 'Block pattern category', 'twentig' );

twentig_register_block_pattern(
	'twentig/hero-with-colored-background',
	array(
		'title'      => __( 'Hero with colored background', 'twentig' ),
		'categories' => array( 'hero' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} --><div class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":1} --><h1 class="has-text-align-center">' . esc_html_x( 'Write the page title', 'Block pattern content', 'twentig' ) . '</h1><!-- /wp:heading --><!-- wp:paragraph {"fontSize":"large","align":"center","style":{"typography":{"lineHeight":"1.35"}}} --><p class="has-text-align-center has-large-font-size" style="line-height:1.35">Lorem ipsum dolor sit amet, commodo erat adipiscing elit. Sed do eiusmod ut tempor incididunt et labore.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/hero-with-button',
	array(
		'title'      => __( 'Hero with button', 'twentig' ),
		'categories' => array( 'hero' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} --><div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":1} --><h1 class="has-text-align-center">' . esc_html_x( 'Write a page title that captivates your audience', 'Block pattern content', 'twentig' ) . '</h1><!-- /wp:heading --><!-- wp:paragraph {"fontSize":"large","align":"center","style":{"typography":{"lineHeight":"1.35"}}} --><p class="has-text-align-center has-large-font-size" style="line-height:1.35">Lorem ipsum dolor sit amet, commodo erat adipiscing elit. Sed do eiusmod ut tempor incididunt et labore.</p><!-- /wp:paragraph --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} --><div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">' . esc_html_x( 'Get started', 'Block pattern content', 'twentig' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/hero-with-button-and-image-on-right',
	array(
		'title'      => __( 'Hero with button and image on right', 'twentig' ),
		'categories' => array( 'hero' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} --><div class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|55"}}},"twStack":"md"} --><div class="wp-block-columns alignwide are-vertically-aligned-center tw-cols-stack-md"><!-- wp:column {"verticalAlignment":"center","layout":{"type":"constrained"}} --><div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1} --><h1 class="wp-block-heading">' . esc_html_x( 'Write the page title', 'Block pattern content', 'twentig' ) . '</h1><!-- /wp:heading --><!-- wp:paragraph {"fontSize":"large","style":{"typography":{"lineHeight":"1.35"}}} --><p class="has-large-font-size" style="line-height:1.35">Lorem ipsum dolor sit amet, commodo erat adipiscing elit. Sed do eiusmod ut tempor incididunt ut labore.</p><!-- /wp:paragraph --><!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} --><div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">' . esc_html_x( 'Learn more', 'Block pattern content', 'twentig' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:column --><!-- wp:column {"verticalAlignment":"center"} --><div class="wp-block-column is-vertically-aligned-center"><!-- wp:image --><figure class="wp-block-image"><img src="' . twentig_get_pattern_asset( 'landscape1.jpg' ) . '" alt=""/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/hero-with-buttons-and-image',
	array(
		'title'      => __( 'Hero with buttons and image', 'twentig' ),
		'categories' => array( 'hero' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} --><div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":1} --><h1 class="wp-block-heading has-text-align-center">' . esc_html_x( 'Write the page title', 'Block pattern content', 'twentig' ) . '</h1><!-- /wp:heading --><!-- wp:paragraph {"fontSize":"large","align":"center","style":{"typography":{"lineHeight":"1.35"}}} --><p class="has-text-align-center has-large-font-size" style="line-height:1.35">Lorem ipsum dolor sit amet, commodo erat adipiscing elit. Sed do eiusmod ut tempor incididunt ut labore et dolore. Integer enim risus suscipit eu iaculis sed, ullamcorper at metus.</p><!-- /wp:paragraph --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} --><div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">' . esc_html_x( 'Get started', 'Block pattern content', 'twentig' ) . '</a></div><!-- /wp:button --><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">' . esc_html_x( 'Learn more', 'Block pattern content', 'twentig' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --><!-- wp:image {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} --><figure class="wp-block-image alignwide" style="margin-top:var(--wp--preset--spacing--60)"><img src="' . twentig_get_pattern_asset( 'wide.jpg' ) . '" alt=""/></figure><!-- /wp:image --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/hero-with-title-on-left-and-image-at-the-bottom',
	array(
		'title'      => __( 'Hero with title on left and image at the bottom', 'twentig' ),
		'categories' => array( 'hero' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base","layout":{"type":"constrained"}} --><div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|55"},"margin":{"bottom":"var:preset|spacing|60"}}},"twStack":"md"} --><div class="wp-block-columns alignwide tw-cols-stack-md" style="margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:column {"layout":{"type":"constrained","justifyContent":"left"}} --><div class="wp-block-column"><!-- wp:heading {"level":1} --><h1 class="wp-block-heading">' . esc_html_x( 'Write the page title', 'Block pattern content', 'twentig' ) . '</h1><!-- /wp:heading --></div><!-- /wp:column --><!-- wp:column {"layout":{"type":"constrained","justifyContent":"left"}} --><div class="wp-block-column"><!-- wp:paragraph {"fontSize":"large","style":{"typography":{"lineHeight":"1.35"}}} --><p class="has-large-font-size" style="line-height:1.35">Lorem ipsum dolor sit amet, commodo erat adipiscing elit. Sed do eiusmod ut tempor incididunt ut labore et dolore. Integer enim risus suscipit, eu iaculis sed at metus.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:image {"align":"wide"} --><figure class="wp-block-image alignwide"><img src="' . twentig_get_pattern_asset( 'wide.jpg' ) . '" alt=""/></figure><!-- /wp:image --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/hero-cover',
	array(
		'title'      => __( 'Hero cover', 'twentig' ),
		'categories' => array( 'hero' ),
		'content'    => '<!-- wp:cover {"url":"' . twentig_get_pattern_asset( 'wide.jpg' ) . '","dimRatio":50,"isUserOverlayColor":true,"minHeight":70,"minHeightUnit":"vh","align":"full","layout":{"type":"constrained"}} --><div class="wp-block-cover alignfull" style="min-height:70vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="' . twentig_get_pattern_asset( 'wide.jpg' ) . '" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1} --><h1 class="wp-block-heading has-text-align-center">' . esc_html_x( 'Write the page title', 'Block pattern content', 'twentig' ) . '</h1><!-- /wp:heading --><!-- wp:paragraph {"fontSize":"large","align":"center","style":{"typography":{"lineHeight":"1.35"}}} --><p class="has-text-align-center has-large-font-size" style="line-height:1.35">Lorem ipsum dolor sit amet commodo erat adipiscing elit. Sed do eiusmod ut tempor incididunt.</p><!-- /wp:paragraph --></div></div><!-- /wp:cover -->',
	)
);

twentig_register_block_pattern(
	'twentig/fullscreen-hero-cover',
	array(
		'title'      => __( 'Fullscreen hero cover', 'twentig' ),
		'categories' => array( 'hero' ),
		'content'    => '<!-- wp:cover {"url":"' . twentig_get_pattern_asset( 'wide.jpg' ) . '","dimRatio":50,"isUserOverlayColor":true,"minHeight":100,"minHeightUnit":"vh","align":"full","layout":{"type":"constrained"}} --><div class="wp-block-cover alignfull" style="min-height:100vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="' . twentig_get_pattern_asset( 'wide.jpg' ) . '" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1} --><h1 class="wp-block-heading has-text-align-center">' . esc_html_x( 'Write a page title that captivates your audience', 'Block pattern content', 'twentig' ) . '</h1><!-- /wp:heading --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} --><div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:button {"backgroundColor":"white","textColor":"black"} --><div class="wp-block-button"><a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button">' . esc_html_x( 'Learn more', 'Block pattern content', 'twentig' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div></div><!-- /wp:cover -->',
	)
);
