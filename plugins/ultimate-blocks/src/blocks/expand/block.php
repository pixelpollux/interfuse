<?php

function ub_render_expand_portion_block($attributes, $content){
    extract($attributes);
	$classNames = array('ub-expand-portion', 'ub-expand-' . esc_attr($displayType));
	if ($displayType === 'full') {
		$classNames[] = 'ub-hide';
	}
	if (isset($className)) {
		$classNames[] = $className;
	}

	$toggle_button_styles = array(
		'text-align' => isset($attributes['toggleAlign']) ? $attributes['toggleAlign'] : 'left',
	);

	$wrapper_attributes = get_block_wrapper_attributes(
		array(
			'class' => join(' ', $classNames),
			'id'    => ($parentID === '' ? '' : "ub-expand-full-" . $parentID),
			'role'  => 'button',
			'aria-expanded' => 'false',
			'aria-controls' => ($parentID === '' ? '' : "ub-expand-full-" . $parentID),
			'tabindex' => '0'
		)
	);

	$filtered_content = apply_filters('ub_expand_portion_fade_content', $content, $attributes);

	return sprintf(
		'<div %1$s>
			%2$s
			<a class="ub-expand-toggle-button" style="%4$s" role="button">
				%3$s
			</a>
		</div>',
		$wrapper_attributes, // 1
		$filtered_content, // 2
		$clickText, // 3
		Ultimate_Blocks\includes\generate_css_string($toggle_button_styles) // 4
	);
}

function ub_register_expand_portion_block($attributes){
    if ( function_exists( 'register_block_type_from_metadata' ) ) {
        require dirname(dirname(__DIR__)) . '/defaults.php';
        register_block_type_from_metadata( dirname(dirname(dirname(__DIR__))) . '/dist/blocks/expand/expand-portion/block.json', array(
            'attributes' => $defaultValues['ub/expand-portion']['attributes'],
			'render_callback' => 'ub_render_expand_portion_block'));
	}
}

function ub_render_expand_block($attributes, $content, $block){
    extract($attributes);

    $scrollTargetPrefix = '';

    switch($scrollTargetType){
        case 'id':
            $scrollTargetPrefix = '#';
            break;
        case 'class':
            $scrollTargetPrefix = '.';
            break;
        case 'element':
        default:
            $scrollTargetPrefix = '';
    }
	$block_attrs = $block->parsed_block['attrs'];

	$padding = Ultimate_Blocks\includes\get_spacing_css( isset($block_attrs['padding']) ? $block_attrs['padding'] : array() );
	$margin  = Ultimate_Blocks\includes\get_spacing_css( isset($block_attrs['margin']) ? $block_attrs['margin'] : array() );

	$styles  = array(
		'padding-top'        => isset($padding['top']) ? $padding['top'] : "",
		'padding-left'       => isset($padding['left']) ? $padding['left'] : "",
		'padding-right'      => isset($padding['right']) ? $padding['right'] : "",
		'padding-bottom'     => isset($padding['bottom']) ? $padding['bottom'] : "",
		'margin-top'         => !empty($margin['top']) ? $margin['top']  : "",
		'margin-left'        => !empty($margin['left']) ? $margin['left']  : "",
		'margin-right'       => !empty($margin['right']) ? $margin['right']  : "",
		'margin-bottom'      => !empty($margin['bottom']) ? $margin['bottom']  : "",
	);
	$classNames = array('wp-block-ub-expand', 'ub-expand');

	$pro_styles = apply_filters('ub_expand_styles', $styles, $block_attrs);

	if(!empty($pro_styles)){
		$styles = array_merge($styles, $pro_styles);
	}

	if (isset($className)) {
		$classNames[] = $className;
	}

	$wrapper_attributes = get_block_wrapper_attributes(
		array(
			'class' => join(' ', $classNames),
			'id'	=> 'ub-expand-' . esc_attr($blockID),
			'style' => Ultimate_Blocks\includes\generate_css_string($styles),
			'data-scroll-type' => $allowScroll ? esc_attr($scrollOption) : 'false',
			'data-scroll-amount' => ($allowScroll && $scrollOption === 'fixedamount') ? esc_attr($scrollOffset) : '',
			'data-scroll-target' => ($allowScroll && $scrollOption === 'namedelement') ? $scrollTargetPrefix . esc_attr($scrollTarget) : ''
		)
	);

	$scrollDataAttributes = ''; // No longer needed as data attributes are included in $wrapper_attributes

	return sprintf(
		'<div %1$s%2$s>%3$s</div>',
		$wrapper_attributes, // 1
		$scrollDataAttributes, // 2
		$content // 3
	);
}

function ub_register_expand_block($attributes){
    if ( function_exists( 'register_block_type_from_metadata' ) ) {
        require dirname(dirname(__DIR__)) . '/defaults.php';
        register_block_type_from_metadata( dirname(dirname(dirname(__DIR__))) . '/dist/blocks/expand/block.json', array(
            'attributes' => $defaultValues['ub/expand']['attributes'],
			'render_callback' => 'ub_render_expand_block'));
	}
}

function ub_expand_block_add_frontend_assets() {
	wp_register_script(
		'ultimate_blocks-expand-block-front-script',
		plugins_url( 'expand/front.build.js', dirname( __FILE__ ) ),
		array( ),
		Ultimate_Blocks_Constants::plugin_version(),
		true
	);
}

add_action('init', 'ub_register_expand_block');
add_action('init', 'ub_register_expand_portion_block');
add_action( 'wp_enqueue_scripts', 'ub_expand_block_add_frontend_assets' );
