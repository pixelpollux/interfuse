<?php
/**
 * Gallery block patterns.
 *
 * @package twentig
 * @phpcs:disable Squiz.Strings.DoubleQuoteUsage.NotRequired
 */

$group_name = esc_html__( 'Gallery', 'twentig' );

twentig_register_block_pattern(
	'twentig/gallery-stack',
	array(
		'title'      => __( 'Gallery: stack', 'twentig' ),
		'categories' => array( 'gallery' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","layout":{"type":"constrained"}} --><div class="wp-block-group alignfull"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} --><h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--60)">' . esc_html_x( 'Write a heading that captivates your audience', 'Block pattern content', 'twentig' ) . '</h2><!-- /wp:heading --><!-- wp:gallery {"columns":1,"imageCrop":false,"linkTo":"none","sizeSlug":"full","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60"}}}} --><figure class="wp-block-gallery has-nested-images columns-1"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} --><figure class="wp-block-image size-full"><img src="' . twentig_get_pattern_asset( 'landscape1.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} --><figure class="wp-block-image size-full"><img src="' . twentig_get_pattern_asset( 'square2.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} --><figure class="wp-block-image size-full"><img src="' . twentig_get_pattern_asset( 'landscape3.jpg' ) . '" alt=""/></figure><!-- /wp:image --></figure><!-- /wp:gallery --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/gallery-2-columns',
	array(
		'title'      => __( 'Gallery 2 columns', 'twentig' ),
		'categories' => array( 'gallery' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","layout":{"type":"constrained"}} --><div class="wp-block-group alignfull"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} --><h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--60)">' . esc_html_x( 'Write a heading that captivates your audience', 'Block pattern content', 'twentig' ) . '</h2><!-- /wp:heading --><!-- wp:gallery {"columns":2,"linkTo":"none","align":"wide","twFixedWidthCols":true,"twColumnWidth":"large"} --><figure class="wp-block-gallery alignwide has-nested-images columns-2 is-cropped tw-fixed-cols tw-cols-large"><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape1.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape2.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape3.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape4.jpg' ) . '" alt=""/></figure><!-- /wp:image --></figure><!-- /wp:gallery --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/gallery-alternating-widths',
	array(
		'title'      => __( 'Gallery: alternating widths', 'twentig' ),
		'categories' => array( 'gallery' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","layout":{"type":"constrained"}} --><div class="wp-block-group alignfull"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} --><h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--60)">' . esc_html_x( 'Write a heading that captivates your audience', 'Block pattern content', 'twentig' ) . '</h2><!-- /wp:heading --><!-- wp:gallery {"columns":2,"linkTo":"none","align":"wide"} --><figure class="wp-block-gallery alignwide has-nested-images columns-2 is-cropped"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"tw-width-100"} --><figure class="wp-block-image size-large tw-width-100"><img src="' . twentig_get_pattern_asset( 'landscape1.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'square2.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'square4.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"tw-width-100"} --><figure class="wp-block-image size-large tw-width-100"><img src="' . twentig_get_pattern_asset( 'landscape3.jpg' ) . '" alt=""/></figure><!-- /wp:image --></figure><!-- /wp:gallery --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/gallery-stretched-images',
	array(
		'title'      => __( 'Gallery: stretched images', 'twentig' ),
		'categories' => array( 'gallery' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","layout":{"type":"constrained"}} --><div class="wp-block-group alignfull"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} --><h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--60)">' . esc_html_x( 'Write a heading that captivates your audience', 'Block pattern content', 'twentig' ) . '</h2><!-- /wp:heading --><!-- wp:gallery {"linkTo":"none","align":"wide"} --><figure class="wp-block-gallery alignwide has-nested-images columns-default is-cropped"><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape1.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape2.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape3.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape4.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape5.jpg' ) . '" alt=""/></figure><!-- /wp:image --></figure><!-- /wp:gallery --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/gallery-3-columns',
	array(
		'title'      => __( 'Gallery 3 columns', 'twentig' ),
		'categories' => array( 'gallery' ),
		'content'    => '<!-- wp:group {"metadata":{"name":"' . $group_name . '"},"align":"full","layout":{"type":"constrained"}} --><div class="wp-block-group alignfull"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} --><h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--60)">' . esc_html_x( 'Write a heading that captivates your audience', 'Block pattern content', 'twentig' ) . '</h2><!-- /wp:heading --><!-- wp:gallery {"columns":3,"linkTo":"none","align":"wide","twFixedWidthCols":true} --><figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped tw-fixed-cols"><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape1.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape2.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape3.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape4.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape5.jpg' ) . '" alt=""/></figure><!-- /wp:image --><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . twentig_get_pattern_asset( 'landscape6.jpg' ) . '" alt=""/></figure><!-- /wp:image --></figure><!-- /wp:gallery --></div><!-- /wp:group -->',
	)
);
