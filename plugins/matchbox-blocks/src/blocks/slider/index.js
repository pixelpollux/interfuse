import { registerBlockType } from '@wordpress/blocks';
import './style-index.scss'; // Frontend styles
import './editor.scss'; // Editor styles

/**
 * Internal dependencies
 */
import '../slide';
import './variations';

import metadata from './block.json';
import save from './save';

// Layout variations
import editBasic from './variations/basic/basic-edit';
import editBoxedCarousel from './variations/boxed-carousel-arrows/boxed-carousel-arrows-edit';
import editPostsCarouselFull from './variations/posts-carousel-full/posts-carousel-full-edit';

const layoutEditMap = {
	basic: editBasic,
	'boxed-carousel-arrows': editBoxedCarousel,
	'posts-carousel-full': editPostsCarouselFull,
};

registerBlockType(metadata.name, {
	edit: (props) => {
		const layout = props.attributes.layout || 'basic';
		const LayoutEdit = layoutEditMap[layout] || editBasic;
		return <LayoutEdit {...props} />;
	},
	save,
});
