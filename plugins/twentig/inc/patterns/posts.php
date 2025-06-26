<?php
/**
 * Query block patterns.
 *
 * @package twentig
 */

$pagination = '<!-- wp:query-pagination-previous {"label":"' . esc_html__( 'Previous', 'twentig' ) . '"} /--><!-- wp:query-pagination-numbers {"midSize":1,"className":"is-style-tw-circle"} /--><!-- wp:query-pagination-next {"label":"' . esc_html__( 'Next', 'twentig' ) . '"} /-->';
$group_name = esc_html_x( 'Posts', 'Block pattern category' ) ;

twentig_register_block_pattern(
	'twentig/posts-2-columns',
	array(
		'title'      => __( 'Posts 2 columns', 'twentig' ),
		'blockTypes' => array( 'core/query' ),
		'categories' => array( 'posts' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"4","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide"} --><div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":2}} --><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|25"},"blockGap":"var:preset|spacing|20"}},"twStretchedLink":true} --><div class="wp-block-group tw-stretched-link" style="margin-bottom:var(--wp--preset--spacing--25)"><!-- wp:post-featured-image {"aspectRatio":"3/2","sizeSlug":"large"} /--><!-- wp:post-title {"isLink":true,"fontSize":"large"} /--><!-- wp:group {"style":{"spacing":{"blockGap":"6px","margin":{"top":"var:preset|spacing|10"}},"typography":{"lineHeight":"1.3"}},"textColor":"secondary","fontSize":"small","layout":{"type":"flex","flexWrap":"wrap"}} --><div class="wp-block-group has-secondary-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--10);line-height:1.3"><!-- wp:post-terms {"term":"category"} /--><!-- wp:paragraph --><p>·</p><!-- /wp:paragraph --><!-- wp:post-date /--></div><!-- /wp:group --></div><!-- /wp:group --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->',
	)
);

twentig_register_block_pattern(
	'twentig/posts-2-columns-text-only',
	array(
		'title'      => __( 'Posts 2 columns: text only', 'twentig' ),
		'blockTypes' => array( 'core/query' ),
		'categories' => array( 'posts' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"4","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide"} --><div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":2}} --><!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"bottom":"var:preset|spacing|30"}},"border":{"bottom":{"width":"1px"}},"dimensions":{"minHeight":"100%"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"},"twStretchedLink":true} --><div class="wp-block-group tw-stretched-link" style="border-bottom-width:1px;min-height:100%;padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group --><div class="wp-block-group"><!-- wp:post-title {"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}},"fontSize":"large"} /--><!-- wp:post-excerpt {"excerptLength":40,"style":{"spacing":{"margin":{"top":"var:preset|spacing|15"}}}} /--></div><!-- /wp:group --><!-- wp:group {"style":{"spacing":{"blockGap":"6px","margin":{"top":"var:preset|spacing|30"}},"typography":{"lineHeight":"1.3"}},"textColor":"secondary","fontSize":"small","layout":{"type":"flex","flexWrap":"wrap"}} --><div class="wp-block-group has-secondary-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--30);line-height:1.3"><!-- wp:post-terms {"term":"category"} /--><!-- wp:paragraph --><p>·</p><!-- /wp:paragraph --><!-- wp:post-date /--></div><!-- /wp:group --></div><!-- /wp:group --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->',
	)
);

twentig_register_block_pattern(
	'twentig/posts-2-columns-cover',
	array(
		'title'      => __( 'Posts 2 columns: cover', 'twentig' ),
		'blockTypes' => array( 'core/query' ),
		'categories' => array( 'posts' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"4","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide"} --><div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"grid","columnCount":2}} --><!-- wp:cover {"useFeaturedImage":true,"isUserOverlayColor":true,"customGradient":"linear-gradient(0deg,rgba(0,0,0,0.8) 0%,rgba(0,0,0,0) 80%)","contentPosition":"bottom left","style":{"spacing":{"padding":{"top":"var:preset|spacing|25","right":"var:preset|spacing|25","bottom":"var:preset|spacing|25","left":"var:preset|spacing|25"}},"border":{"radius":"16px"},"dimensions":{"aspectRatio":"1"}},"twStretchedLink":true,"twHover":"zoom"} --><div class="wp-block-cover has-custom-content-position is-position-bottom-left tw-stretched-link tw-hover-zoom" style="border-radius:16px;padding-top:var(--wp--preset--spacing--25);padding-right:var(--wp--preset--spacing--25);padding-bottom:var(--wp--preset--spacing--25);padding-left:var(--wp--preset--spacing--25)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient" style="background:linear-gradient(0deg,rgba(0,0,0,0.8) 0%,rgba(0,0,0,0) 80%)"></span><div class="wp-block-cover__inner-container"><!-- wp:post-title {"isLink":true,"className":"tw-link-no-underline","fontSize":"large"} /--><!-- wp:group {"style":{"spacing":{"blockGap":"6px","margin":{"top":"var:preset|spacing|10"}},"typography":{"lineHeight":"1.3"}},"fontSize":"x-small","layout":{"type":"flex","flexWrap":"wrap"}} --><div class="wp-block-group has-x-small-font-size" style="margin-top:var(--wp--preset--spacing--10);line-height:1.3"><!-- wp:post-terms {"term":"category"} /--><!-- wp:paragraph --><p>·</p><!-- /wp:paragraph --><!-- wp:post-date /--></div><!-- /wp:group --></div></div><!-- /wp:cover --><!-- /wp:post-template --><!-- wp:query-pagination {"className":" tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->'
	)
);

twentig_register_block_pattern(
	'twentig/posts-3-columns',
	array(
		'title'      => __( 'Posts 3 columns', 'twentig' ),
		'blockTypes' => array( 'core/query' ),
		'categories' => array( 'posts' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"3","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"enhancedPagination":true,"align":"wide","layout":{"type":"constrained"}} --><div class="wp-block-query alignwide"><!-- wp:post-template {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","columnCount":3},"twColumnWidth":"large"} --><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}},"twStretchedLink":true} --><div class="wp-block-group tw-stretched-link" style="margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:post-featured-image {"aspectRatio":"3/2"} /--><!-- wp:post-title {"isLink":true,"fontSize":"large"} /--><!-- wp:post-excerpt {"moreText":"","excerptLength":20,"style":{"spacing":{"margin":{"top":"var:preset|spacing|15"}}}} /--><!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"textColor":"secondary","fontSize":"x-small","layout":{"type":"flex","allowOrientation":false}} --><div class="wp-block-group has-secondary-color has-text-color has-x-small-font-size"><!-- wp:post-date /--><!-- wp:paragraph --><p>·</p><!-- /wp:paragraph --><!-- wp:post-terms {"term":"category","className":"tw-link-hover-underline"} /--></div><!-- /wp:group --></div><!-- /wp:group --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->',
	)
);

twentig_register_block_pattern(
	'twentig/posts-3-columns-card',
	array(
		'title'      => __( 'Posts 3 columns: card', 'twentig' ),
		'blockTypes' => array( 'core/query' ),
		'categories' => array( 'posts' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"3","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide"} --><div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"grid","columnCount":3},"twColumnWidth":"large"} --><!-- wp:group {"style":{"dimensions":{"minHeight":"100%"},"border":{"radius":"16px"},"spacing":{"blockGap":"var:preset|spacing|15"}},"backgroundColor":"base-2","layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"},"twStretchedLink":true} --><div class="wp-block-group has-base-2-background-color has-background tw-stretched-link" style="border-radius:16px;min-height:100%"><!-- wp:group --><div class="wp-block-group"><!-- wp:post-featured-image {"aspectRatio":"16/9","sizeSlug":"large","style":{"border":{"radius":"0px"}},"twHover":"zoom"} /--><!-- wp:post-title {"isLink":true,"className":"tw-link-no-underline","style":{"spacing":{"padding":{"left":"var:preset|spacing|20","right":"var:preset|spacing|20","top":"var:preset|spacing|20"},"margin":{"top":"0","bottom":"0"}}},"fontSize":"large"} /--></div><!-- /wp:group --><!-- wp:group {"style":{"spacing":{"blockGap":"6px","padding":{"right":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20"}},"typography":{"lineHeight":"1.3"}},"textColor":"secondary","fontSize":"x-small","layout":{"type":"flex","flexWrap":"wrap"}} --><div class="wp-block-group has-secondary-color has-text-color has-x-small-font-size" style="padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20);line-height:1.3"><!-- wp:post-terms {"term":"category"} /--><!-- wp:paragraph --><p>·</p><!-- /wp:paragraph --><!-- wp:post-date /--></div><!-- /wp:group --></div><!-- /wp:group --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->',
	)
);

twentig_register_block_pattern(
	'twentig/posts-image-on-left',
	array(
		'title'      => __( 'Posts: image on left', 'twentig' ),
		'blockTypes' => array( 'core/query' ),
		'categories' => array( 'posts' ),
		'content'    => '<!-- wp:query {"metadata":{"name":"' . $group_name . '"},"query":{"perPage":"3","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide"} --><div class="wp-block-query alignwide"><!-- wp:post-template --><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|55"}}}} --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3"} /--></div><!-- /wp:column --><!-- wp:column {"verticalAlignment":"center"} --><div class="wp-block-column is-vertically-aligned-center"><!-- wp:post-title {"isLink":true,"fontSize":"x-large"} /--><!-- wp:post-excerpt {"excerptLength":30,"style":{"spacing":{"margin":{"top":"var:preset|spacing|15"}}}} /--><!-- wp:group {"style":{"spacing":{"blockGap":"6px","margin":{"top":"var:preset|spacing|20"}}},"textColor":"secondary","fontSize":"small","layout":{"type":"flex","allowOrientation":false}} --><div class="wp-block-group has-secondary-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--20)"><!-- wp:post-date /--><!-- wp:paragraph --><p>·</p><!-- /wp:paragraph --><!-- wp:post-terms {"term":"category"} /--></div><!-- /wp:group --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}}} --><hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)"/><!-- /wp:separator --><!-- /wp:post-template --><!-- wp:query-pagination {"className":"tw-link-hover-underline","layout":{"type":"flex","justifyContent":"center"}} -->' . $pagination . '<!-- /wp:query-pagination --></div><!-- /wp:query -->',
	)
);
