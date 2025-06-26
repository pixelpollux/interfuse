<?php
require_once dirname(dirname(dirname(__DIR__))) . '/includes/ultimate-blocks-styles-css-generator.php';
require_once dirname(dirname(dirname(__DIR__))) . '/src/common.php';

function ub_render_styled_list_block($attributes, $contents, $block){
    extract($attributes);

    $listItems = '';

    if(json_encode($listItem) === '[' . join(',', array_fill(0, 3,'{"text":"","selectedIcon":"check","indent":0}')) . ']'){
        $listItems = $list;
    }
    else{
        $sortedItems = [];

        foreach($listItem as $elem){
            $last = count($sortedItems) - 1;
            if (count($sortedItems) === 0 || $sortedItems[$last][0]['indent'] < $elem['indent']) {
                array_push($sortedItems, array($elem));
            }
            else if ($sortedItems[$last][0]['indent'] === $elem['indent']){
                array_push($sortedItems[$last], $elem);
            }
            else{
                while($sortedItems[$last][0]['indent'] > $elem['indent']){
                    array_push($sortedItems[count($sortedItems) - 2], array_pop($sortedItems));
                    $last = count($sortedItems) - 1;
                }
                if($sortedItems[$last][0]['indent'] === $elem['indent']){
                    array_push($sortedItems[$last], $elem);
                }
            }
        }

        while(count($sortedItems) > 1 &&
            $sortedItems[count($sortedItems) - 1][0]['indent'] > $sortedItems[count($sortedItems) - 2][0]['indent']){
            array_push($sortedItems[count($sortedItems) - 2], array_pop($sortedItems));
        }

        $sortedItems = $sortedItems[0];

        if (!function_exists('ub_makeList')) {
            function ub_makeList($num, $item, $color, $size){
                static $outputString = '';
                if($num === 0 && $outputString != ''){
                    $outputString = '';
                }
                if (isset($item['indent'])){
                    $outputString .= '<li>'.($item['text'] === '' ? '<br/>' : $item['text']) . '</li>';
                }
                else{
                    $outputString = substr_replace($outputString, '<ul class="fa-ul">',
                        strrpos($outputString, '</li>'), strlen('</li>'));

                    forEach($item as $key => $subItem){
                        ub_makeList($key+1, $subItem, $color, $size);
                    }
                    $outputString .= '</ul>' . '</li>';
                }
                return $outputString;
            }
        }

        foreach($sortedItems as $key => $item){
            $listItems = ub_makeList($key, $item, $iconColor, $iconSize);
        }
    }
    $list_alignment_class = !empty($listAlignment) ? "ub-list-alignment-" . esc_attr($listAlignment) : "";


	$block_attributes  = isset($block->parsed_block['attrs']) ? $block->parsed_block['attrs'] : array();

    	$padding = Ultimate_Blocks\includes\get_spacing_css( isset($block_attributes['padding']) ? $block_attributes['padding'] : array() );
	$margin = Ultimate_Blocks\includes\get_spacing_css( isset($block_attributes['margin']) ? $block_attributes['margin'] : array() );
	$iconData = Ultimate_Blocks_IconSet::generate_fontawesome_icon( $attributes['selectedIcon'] );

	$list_styles = array(
		'padding-top'         => isset($padding['top']) ? esc_attr($padding['top']) : "",
		'padding-left'        => isset($padding['left']) ? esc_attr($padding['left']) : "",
		'padding-right'       => isset($padding['right']) ? esc_attr($padding['right']) : "",
		'padding-bottom'      => isset($padding['bottom']) ? esc_attr($padding['bottom']) : "",
		'margin-top'          => !empty($margin['top']) ? esc_attr($margin['top']) . " !important" : "",
		'margin-left'         => !empty($margin['left']) ? esc_attr($margin['left']) . " !important" : "",
		'margin-right'        => !empty($margin['right']) ? esc_attr($margin['right']) . " !important" : "",
		'margin-bottom'       => !empty($margin['bottom']) ? esc_attr($margin['bottom']) . " !important" : "",
		'background-color'    => !empty($attributes['backgroundColor']) ? esc_attr($attributes['backgroundColor']) : "",
	);

	$list_styles['text-align'] = $attributes['alignment'];
	if (isset($attributes['textColor'])) {
		$list_styles['color'] = $attributes['textColor'];
	}
	if (isset($attributes['backgroundColor'])) {
		$list_styles['background-color'] = $attributes['backgroundColor'];
	}
	$list_styles['--ub-list-item-icon-top'] = ( $attributes['iconSize'] >= 5 ? 3 : ( $attributes['iconSize'] < 3 ? 2 : 0 ) ) . 'px;';
	$list_styles['--ub-list-item-icon-size'] = ( ( 4 + $attributes['iconSize'] ) / 10 ) . 'em';
	$list_styles['--ub-list-item-background-image'] = 'url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $iconData[0] . ' ' . $iconData[1] . '"><path fill="%23' . substr( $attributes['iconColor'], 1 ) . '" d="' . $iconData[2] . '"></path></svg>\')';
	if ( $attributes['iconSize'] < 3 ) {
		$list_styles['--ub-list-item-fa-li-top'] = '-0.1em';
	} elseif ( $attributes['iconSize'] >= 5 ) {
		$list_styles['--ub-list-item-fa-li-top'] = '3px';
	}

	if(isset($attributes['itemSpacing']) && $isRootList){
		$list_styles['--ub-list-item-spacing'] = $attributes['itemSpacing'] . 'px';
	}

	if(!isset($padding['left']) ){
		$list_styles['padding-left'] = isset($attributes['iconSize']) ? ( ( 6 + $attributes['iconSize'] ) / 10 ) . 'em' : "";
	}
	$list_layout_styles = array(
		'text-align'         			=> isset($attributes['alignment']) ? esc_attr($attributes['alignment']) : "",
		'color'              			=> !empty($attributes['textColor']) ? esc_attr($attributes['textColor']) : "",
	);
	if ($isRootList) {
		$list_layout_styles['column-count'] = isset($attributes['columns']) ? esc_attr($attributes['columns']) : "";
		$list_layout_styles['--ub-list-mobile-column-count'] = isset($attributes['maxMobileColumns']) ? esc_attr($attributes['maxMobileColumns']) : "";
	}

	if(!empty($listAlignment) && $listAlignment === 'left'){
		$list_layout_styles['width'] = 'fit-content';
		$list_layout_styles['margin-right'] = 'auto';
		$list_layout_styles['margin-left'] = '0';
	}
	if(!empty($listAlignment) && $listAlignment === 'center'){
		$list_layout_styles['width'] = 'fit-content';
		$list_layout_styles['margin-right'] = 'auto';
		$list_layout_styles['margin-left'] = 'auto';
	}
	if(!empty($listAlignment) && $listAlignment === 'right'){
		$list_layout_styles['width'] = 'fit-content';
		$list_layout_styles['margin-right'] = '0';
		$list_layout_styles['margin-left'] = 'auto';
	}

	$classes = array('wp-block-ub-styled-list');
	$classes[] = $isRootList ? "ub_styled_list" : "ub_styled_list_sublist";
	if (!empty($list_alignment_class)) {
		$classes[] = $list_alignment_class;
	}
	if (isset($className)) {
		$classes[] = esc_attr($className);
	}

	$wrapper_attributes = get_block_wrapper_attributes(
		array(
			'class' => implode(' ', $classes),
			'id' 	=> $blockID === '' ? null : 'ub_styled_list-' . $blockID,
			'style' => Ultimate_Blocks\includes\generate_css_string($list_styles),
		)
	);
    if($list === ''){
		return sprintf(
			'<ul %1$s><div class="ub-block-list__layout" style="%3$s">%2$s</div></ul>',
			$wrapper_attributes, //1
			Ultimate_Blocks\includes\strip_xss($contents), //2
			Ultimate_Blocks\includes\generate_css_string($list_layout_styles) //3
		);
    }
    else{
		return sprintf(
			'<div %1$s><ul class="fa-ul">%2$s</ul></div>',
			$wrapper_attributes, //1
			wp_kses_post($listItems) //2
		);
    }

}

function ub_register_styled_list_block() {
	if ( function_exists( 'register_block_type_from_metadata' ) ) {
        require dirname(dirname(__DIR__)) . '/defaults.php';
        register_block_type_from_metadata( dirname(dirname(dirname(__DIR__))) . '/dist/blocks/styled-list/block.json', array(
            'attributes' => $defaultValues['ub/styled-list']['attributes'],

            'render_callback' => 'ub_render_styled_list_block'));
	}
}

function ub_render_styled_list_item_block($attributes, $contents, $block){
    	extract($attributes);
	$block_attributes  = isset($block->parsed_block['attrs']) ? $block->parsed_block['attrs'] : array();

    	$padding 	= Ultimate_Blocks\includes\get_spacing_css( isset($block_attributes['padding']) ? $block_attributes['padding'] : array() );
	$margin 	= Ultimate_Blocks\includes\get_spacing_css( isset($block_attributes['margin']) ? $block_attributes['margin'] : array() );
	$iconData = !empty($attributes['selectedIcon'] ) ?  Ultimate_Blocks_IconSet::generate_fontawesome_icon( $attributes['selectedIcon'] ) : array();

	$list_item_styles = array(
		'padding-top'         			=> isset($padding['top']) ? esc_attr($padding['top']) : "",
		'padding-left'        			=> isset($padding['left']) ? esc_attr($padding['left']) : "",
		'padding-right'       			=> isset($padding['right']) ? esc_attr($padding['right']) : "",
		'padding-bottom'      			=> isset($padding['bottom']) ? esc_attr($padding['bottom']) : "",
		'margin-top'       	 			=> !empty($margin['top']) ? esc_attr($margin['top']) . " !important" : "",
		'margin-left'       			=> !empty($margin['left']) ? esc_attr($margin['left']) . " !important" : "",
		'margin-right'      			=> !empty($margin['right']) ? esc_attr($margin['right']) . " !important" : "",
		'margin-bottom'     			=> !empty($margin['bottom']) ? esc_attr($margin['bottom']) . " !important" : "",
		'font-size'					=> $attributes['fontSize'] > 0 ?  ( $attributes['fontSize'] ) . 'px;' : '',
		'--ub-list-item-icon-top' 		=> ( $attributes['iconSize'] >= 5 ? 3 : ( $attributes['iconSize'] < 3 ? 2 : 0 ) ) . 'px',
		'--ub-list-item-icon-size' 		=> ( ( 4 + $attributes['iconSize'] ) / 10 ) . 'em',
		'--ub-list-item-background-image' 	=> 'url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $iconData[0] . ' ' . $iconData[1] . '"><path fill="%23' . substr( $attributes['iconColor'], 1 ) . '" d="' . $iconData[2] . '"></path></svg>\')',
	);
	return sprintf(
		'<li class="ub_styled_list_item" style="%1$s">
			<div class="ub_list_item_content">
				<span class="ub_list_item_icon">
					<svg width="%8$s" height="%8$s" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %4$s %5$s">
						<path fill="%6$s" d="%7$s"></path>
					</svg>
				</span>
				<span class="ub_list_item_text">%2$s</span>
			</div>
			%3$s
		</li>',
		Ultimate_Blocks\includes\generate_css_string( $list_item_styles ), // 1
		wp_kses_post($itemText), // 2
		Ultimate_Blocks\includes\strip_xss($contents), // 3
		esc_attr($iconData[0]), // 4 - SVG width
		esc_attr($iconData[1]), // 5 - SVG height
		esc_attr($attributes['iconColor']), // 6 - Icon color
		esc_attr($iconData[2]), // 7 - SVG path data
		esc_attr(( ( 4 + $attributes['iconSize'] ) / 10 ) . 'em') // 8 - Icon size
	);
}

function ub_register_styled_list_item_block(){
    if ( function_exists( 'register_block_type_from_metadata' ) ) {
        require dirname(dirname(__DIR__)) . '/defaults.php';
        register_block_type_from_metadata( dirname(dirname(dirname(__DIR__))) . '/dist/blocks/styled-list/style-list-item/block.json', array(
            'attributes' => $defaultValues['ub/styled-list-item']['attributes'],
            'render_callback' => 'ub_render_styled_list_item_block'));
	}
}

add_action('init', 'ub_register_styled_list_block');
add_action('init', 'ub_register_styled_list_item_block');
