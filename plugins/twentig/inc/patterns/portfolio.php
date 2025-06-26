<?php
/**
 * Query block patterns.
 *
 * @package twentig
 */

$pagination = '<!-- wp:query-pagination-previous {"label":"' . esc_html__( 'Previous', 'twentig' ) . '"} /--><!-- wp:query-pagination-numbers {"midSize":1,"className":"is-style-tw-circle"} /--><!-- wp:query-pagination-next {"label":"' . esc_html__( 'Next', 'twentig' ) . '"} /-->';
$group_name = esc_html_x( 'Portfolio', 'Block pattern category' ) ;

if ( ! twentig_is_option_enabled( 'portfolio' ) ) {
	return;
}

twentig_register_block_pattern(
	'twentig/portfolio-2-columns',
	array(
		'title'      => __( 'Portfolio 2 columns', 'twentig' ),
		'categories' => array( 'portfolio' ),
		'blockTypes' => array( 'core/query/twentig/portfolio-list' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"24","pages":0,"offset":0,"postType":"portfolio","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"namespace":"twentig/portfolio-list","align":"wide"} --><div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":2}} --><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}},"twStretchedLink":true} --><div class="wp-block-group tw-stretched-link" style="margin-bottom:var(--wp--preset--spacing--20)"><!-- wp:post-featured-image {"aspectRatio":"4/3","sizeSlug":"large"} /--><!-- wp:post-title {"isLink":true,"fontSize":"large"} /--><!-- wp:post-terms {"term":"portfolio_category","style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}},"typography":{"lineHeight":"1.3"}},"textColor":"secondary","fontSize":"small","twUnlink":true} /--></div><!-- /wp:group --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->',
	)
);

twentig_register_block_pattern(
	'twentig/portfolio-3-columns-full-width',
	array(
		'title'      => __( 'Portfolio 3 columns: full width', 'twentig' ),
		'categories' => array( 'portfolio' ),
		'blockTypes' => array( 'core/query/twentig/portfolio-list' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|site-padding","left":"var:preset|spacing|site-padding"}}}} --><div class="wp-block-group alignfull" style="padding-right:var(--wp--preset--spacing--site-padding);padding-left:var(--wp--preset--spacing--site-padding)"><!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"24","pages":0,"offset":0,"postType":"portfolio","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"namespace":"twentig/portfolio-list"} --><div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","columnCount":3},"twColumnWidth":"large"} --><!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|30"}}},"twStretchedLink":true} --><div class="wp-block-group tw-stretched-link" style="padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:post-featured-image {"aspectRatio":"4/3","twHover":"fade"} /--><!-- wp:post-title {"isLink":true,"fontSize":"large"} /--></div><!-- /wp:group --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query --></div><!-- /wp:group -->',
	)
);

twentig_register_block_pattern(
	'twentig/portfolio-image-on-left',
	array(
		'title'      => __( 'Portfolio: image on left', 'twentig' ),
		'categories' => array( 'portfolio' ),
		'blockTypes' => array( 'core/query/twentig/portfolio-list' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"24","pages":0,"offset":0,"postType":"portfolio","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"namespace":"twentig/portfolio-list","align":"wide"} --><div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}}} --><!-- wp:group {"twStretchedLink":true} --><div class="wp-block-group tw-stretched-link"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|55"}}}} --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:post-featured-image {"aspectRatio":"4/3"} /--></div><!-- /wp:column --><!-- wp:column {"verticalAlignment":"center"} --><div class="wp-block-column is-vertically-aligned-center"><!-- wp:post-title {"isLink":true,"fontSize":"x-large"} /--><!-- wp:post-excerpt {"excerptLength":25,"style":{"spacing":{"margin":{"top":"var:preset|spacing|15"}}}} /--></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:group --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->',
	)
);

twentig_register_block_pattern(
	'twentig/portfolio-2-columns-cover',
	array(
		'title'      => __( 'Portfolio 2 columns: cover', 'twentig' ),
		'categories' => array( 'portfolio' ),
		'blockTypes' => array( 'core/query/twentig/portfolio-list' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"24","pages":0,"offset":"0","postType":"portfolio","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[]},"namespace":"twentig/portfolio-list","align":"wide"} --><div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","columnCount":2}} --><!-- wp:cover {"useFeaturedImage":true,"dimRatio":50,"isUserOverlayColor":true,"contentPosition":"center center","style":{"dimensions":{"aspectRatio":"4/3"}},"twStretchedLink":true,"twHover":"show-text-alt"} --><div class="wp-block-cover tw-stretched-link tw-hover-show-text-alt"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:post-title {"textAlign":"center","isLink":true,"className":"tw-link-no-underline","fontSize":"x-large"} /--><!-- wp:post-terms {"term":"portfolio_category","textAlign":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}}} /--></div></div><!-- /wp:cover --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->',
	)
);

twentig_register_block_pattern(
	'twentig/portfolio-3-columns-cover',
	array(
		'title'      => __( 'Portfolio 3 columns: cover', 'twentig' ),
		'categories' => array( 'portfolio' ),
		'blockTypes' => array( 'core/query/twentig/portfolio-list' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"24","pages":0,"offset":"0","postType":"portfolio","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[]},"namespace":"twentig/portfolio-list","align":"wide"} --><div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"grid","columnCount":3},"twColumnWidth":"large"} --><!-- wp:cover {"useFeaturedImage":true,"isUserOverlayColor":true,"customGradient":"linear-gradient(0deg,rgba(0,0,0,0.7) 0%,rgba(0,0,0,0) 80%)","contentPosition":"bottom left","style":{"spacing":{"padding":{"top":"var:preset|spacing|25","bottom":"var:preset|spacing|25","left":"var:preset|spacing|25","right":"var:preset|spacing|25"}},"twStretchedLink":true,"twHover":"zoom","dimensions":{"aspectRatio":"1"}}} --><div class="wp-block-cover has-custom-content-position is-position-bottom-left tw-stretched-link tw-hover-zoom" style="padding-top:var(--wp--preset--spacing--25);padding-right:var(--wp--preset--spacing--25);padding-bottom:var(--wp--preset--spacing--25);padding-left:var(--wp--preset--spacing--25)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient" style="background:linear-gradient(0deg,rgba(0,0,0,0.7) 0%,rgba(0,0,0,0) 80%)"></span><div class="wp-block-cover__inner-container"><!-- wp:post-title {"isLink":true,"className":"tw-link-no-underline","fontSize":"large"} /--></div></div><!-- /wp:cover --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->',
	)
);
