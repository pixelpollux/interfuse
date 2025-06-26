import { registerBlockVariation } from '@wordpress/blocks';

registerBlockVariation('matchbox/slider', {
	name: 'basic',
	title: 'Basic Slider',
	description: 'A simple manual content slider using Group blocks.',
	isDefault: true,
	attributes: {
		layout: 'basic',
	},
	icon: 'images-alt2',
});

registerBlockVariation('matchbox/slider', {
	name: 'boxed-carousel-arrows',
	title: 'Boxed Carousel with Arrows',
	description: 'A carousel slider with boxed navigation arrows.',
	attributes: {
		layout: 'boxed-carousel-arrows',
		className: 'slider-block-boxed-carousel',
		sliderType: 'slide',
		arrows: true,
		pagination: false,
		sliderAlign: 'alignfull',
	},
	isDefault: false,
});

registerBlockVariation('matchbox/slider', {
	name: 'posts-carousel-full',
	title: 'Posts Carousel Full Width',
	description:
		'A full-width posts carousel with centered slides and peek effect.',
	attributes: {
		layout: 'posts-carousel-full',
		className: 'slider-block-posts-carousel-full',
	},
});
