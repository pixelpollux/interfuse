<?php
/**
 * Render the slider block.
 *
 * @package MatchboxBlocks
 */

$layout = $attributes['layout'] ?? 'basic';

// If the layout is basic, we can just return the content as is using save.js.
if ( 'basic' === $layout ) {
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $content;
	return;
}

// If the layout is a dynamic layout, we need to render it here.
if ( in_array( $layout, [ 'boxed-carousel-arrows', 'posts-carousel-full' ], true ) ) {
	$current_post_type = $attributes['postType'] ?? 'post';
	$posts_to_show     = $attributes['postsToShow'] ?? 4;

	$query = new WP_Query(
		[
			'post_type'      => $current_post_type,
			'posts_per_page' => $posts_to_show,
		]
	);

	if ( $query->have_posts() ) :
		$wrapper_class = 'splide';
		$slide_class   = 'splide__slide wp-block-matchbox-slide';
		$block_class   = 'slider-block-' . sanitize_html_class( $layout );

		if ( 'posts-carousel-full' === $layout ) {
			$wrapper_class .= ' posts-carousel-full-wrapper';
		}

		?>
		<div
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo get_block_wrapper_attributes(
			[
				'class' => "{$block_class} {$wrapper_class}",
			]
		);
		?>
			data-type="slide"
			data-arrows="true"
			data-items-mobile="<?php echo esc_attr( $attributes['itemsMobile'] ?? 1 ); ?>"
			data-items-tablet="<?php echo esc_attr( $attributes['itemsTablet'] ?? 2 ); ?>"
			data-items-desktop="<?php echo esc_attr( $attributes['itemsDesktop'] ?? 4 ); ?>"
		>
			<div class="splide__track">
				<ul class="splide__list">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<li class="splide__slide wp-block-matchbox-slide">
							<div class="slide-content">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="slide-content__image">
										<img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>" />
									</div>
								<?php endif; ?>
								<p class="slide-content__title" style="font-weight:600;font-size:1.25rem"><?php the_title(); ?></p>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	endif;
} else {
	// ❌ Not a dynamic layout — fallback to frontend output from save.js
	// Render nothing and rely on the static block save content
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $content;
}
