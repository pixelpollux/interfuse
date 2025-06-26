<?php

use function Ultimate_Blocks\includes\generate_css_string;

/**
 * Enqueue frontend script for content toggle block
 *
 * @return void
 */

function ub_render_image_slider_block($attributes, $_, $block){
    extract($attributes);

    $block_attrs = $block->parsed_block['attrs'];

    $imageArray = isset($pics) ? (count($pics) > 0 ? $pics : json_decode($images, true)) : array();
    $captionArray = isset($descriptions) ? count($descriptions) > 0 ? $descriptions : json_decode($captions, true) : array();

    $gallery = '';
    $sliderHeight = isset($attributes['sliderHeight']) ? $attributes['sliderHeight'] : 200; // Default height
    $swiper_slide_image_styles = array('height' => $sliderHeight . 'px;');

    foreach($imageArray as $key => $image){
        $gallery .= sprintf(
            '<figure class="swiper-slide">
                <img src="%1$s" alt="%2$s" style="%3$s">
                <figcaption class="ub_image_slider_image_caption">%4$s%5$s%6$s</figcaption>
            </figure>',
            esc_url($image['url']), // 1
            esc_attr($image['alt']), // 2
            Ultimate_Blocks\includes\generate_css_string($swiper_slide_image_styles), // 3
            ($captionArray[$key]['link'] === '' ? '' : '<a href="' . esc_url($captionArray[$key]['link']) . '">'), // 4
            wp_kses_post($captionArray[$key]['text']), // 5
            ($captionArray[$key]['link'] === '' ? '' : '</a>') // 6
        );
    }

    $classes = array('ub_image_slider', 'swiper-container');
    if (!empty($align)) {
        $classes[] = 'align' . esc_attr($align);
    }
	$margin = Ultimate_Blocks\includes\get_spacing_css(isset($block_attrs['margin']) ? $block_attrs['margin'] : array());
	$padding = Ultimate_Blocks\includes\get_spacing_css(isset($block_attrs['padding']) ? $block_attrs['padding'] : array());
	$navigationColor = isset($attributes['navigationColor']) ? $attributes['navigationColor'] : '';
	$activePaginationColor = isset($attributes['activePaginationColor']) ? $attributes['activePaginationColor'] : '';
	$paginationColor = isset($attributes['paginationColor']) ? $attributes['paginationColor'] : '';

	$image_slider_wrapper_styles = array(
		'--swiper-navigation-color'				=> $navigationColor,
		'--swiper-pagination-color'				=> $activePaginationColor,
		'--swiper-inactive-pagination-color'	=> $paginationColor,
		'--swiper-navigation-background-color'	=> Ultimate_Blocks\includes\get_background_color_var($attributes, 'navigationBackgroundColor', 'navigationGradientColor'),
		'padding-top'           			 	=> isset($padding['top']) ? $padding['top'] : "",
		'padding-left'          			 	=> isset($padding['left']) ? $padding['left'] : "",
		'padding-right'         			 	=> isset($padding['right']) ? $padding['right'] : "",
		'padding-bottom'        			 	=> isset($padding['bottom']) ? $padding['bottom'] : "",
		'margin-top'            			 	=> isset($margin['top']) ? $margin['top']  : "",
		'margin-right'          			 	=> isset($margin['left']) ? $margin['left']  : "",
		'margin-bottom'         			 	=> isset($margin['right']) ? $margin['right']  : "",
		'margin-left'           			 	=> isset($margin['bottom']) ? $margin['bottom']  : "",
		'min-height' 							=> (35 + $sliderHeight) . 'px;',
	);

    $wrapper_attributes = get_block_wrapper_attributes(
        array(
            'class' => implode(' ', $classes),
            'style' => Ultimate_Blocks\includes\generate_css_string($image_slider_wrapper_styles),
        )
    );

    $slider_html = sprintf(
        '<div %1$s %2$s data-swiper-data=\'{"speed":%3$s,"spaceBetween":%4$s,"slidesPerView":%5$s,"loop":%6$s,"pagination":{"el": %7$s , "type": "%8$s"%9$s},%10$s "keyboard": { "enabled": true }, "effect": "%11$s"%12$s%13$s%14$s%15$s%16$s%17$s}\'>
            <div class="swiper-wrapper">%18$s</div>
            <div class="swiper-pagination"></div>
            %19$s
        </div>',
        $wrapper_attributes, // 1
        ($blockID === '' ? 'style="min-height: ' . (25 + (count($imageArray) > 0 ? esc_attr($sliderHeight) : 200)) . 'px;"' : 'id="ub_image_slider_' . esc_attr($blockID) . '"'), // 2
        esc_attr($speed), // 3
        esc_attr($spaceBetween), // 4
        esc_attr($slidesPerView), // 5
        json_encode($wrapsAround), // 6
        ($usePagination ? '".swiper-pagination"' : 'null'), // 7
        esc_attr($paginationType), // 8
        ($paginationType === 'bullets' ? ', "clickable":true' : ''), // 9
        ($useNavigation ? '"navigation": {"nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev"},' : ''), // 10
        esc_attr($transition), // 11
        ($transition === 'fade' ? ',"fadeEffect":{"crossFade": true}' : ''), // 12
        ($transition === 'coverflow' ? ',"coverflowEffect":{"slideShadows":' . json_encode($slideShadows) . ', "rotate": ' . esc_attr($rotate) . ', "stretch": ' . esc_attr($stretch) . ', "depth": ' . esc_attr($depth) . ', "modifier": ' . esc_attr($modifier) . '}' : ''), // 13
        ($transition === 'cube' ? ',"cubeEffect":{"slideShadows":' . json_encode($slideShadows) . ', "shadow":' . json_encode($shadow) . ', "shadowOffset":' . esc_attr($shadowOffset) . ', "shadowScale":' . esc_attr($shadowScale) . '}' : ''), // 14
        ($transition === 'flip' ? ', "flipEffect":{"slideShadows":' . json_encode($slideShadows) . ', "limitRotation": ' . json_encode($limitRotation) . '}' : ''), // 15
        ($autoplays ? ',"autoplay":{"delay": '. ($autoplayDuration * 1000) . '}' : ''), // 16
        (!$isDraggable ? ',"simulateTouch":false' : ''), // 17
        $gallery, // 18
        ($useNavigation ? '<div class="swiper-button-prev"></div> <div class="swiper-button-next"></div>' : "") // 19
    );
    if (defined( 'ULTIMATE_BLOCKS_PRO_LICENSE' ) && ULTIMATE_BLOCKS_PRO_LICENSE) {
	   $slider_html = apply_filters('ubpro_image_slider_filter', $slider_html, $block);
    }
    return $slider_html;
}


function ub_register_image_slider_block(){
    if ( function_exists( 'register_block_type_from_metadata' ) ) {
        require dirname(dirname(__DIR__)) . '/defaults.php';
        register_block_type_from_metadata(dirname(dirname(dirname(__DIR__))) . '/dist/blocks/image-slider/block.json', array(
            'attributes' => $defaultValues['ub/image-slider']['attributes'],
            'render_callback' => 'ub_render_image_slider_block'));
    }
}

function ub_image_slider_add_frontend_assets() {
	wp_register_script(
		'ultimate_blocks-swiper',
		plugins_url( '/swiper-bundle.js', __FILE__ ),
		array(),
		Ultimate_Blocks_Constants::plugin_version()
	);
	wp_register_script(
		'ultimate_blocks-image-slider-init-script',
		plugins_url( '/front.build.js', __FILE__ ),
		array('ultimate_blocks-swiper'),
		Ultimate_Blocks_Constants::plugin_version(),
		true
	);
}

add_action('init', 'ub_register_image_slider_block');
add_action( 'wp_enqueue_scripts', 'ub_image_slider_add_frontend_assets' );
