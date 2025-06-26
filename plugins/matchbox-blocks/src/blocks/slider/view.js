import { initBasicSlider } from './slider-inits/basic';
import { initBoxedCarouselArrowsSlider } from './slider-inits/boxed-carousel-arrows';
import { initPostsCarouselFull } from './slider-inits/posts-carousel-full-init';
import './style-index.scss';

document.addEventListener('DOMContentLoaded', () => {
	// Initialize basic slider.
	document.querySelectorAll('.slider-block-basic.splide').forEach((el) => {
		initBasicSlider(el);
	});

	document
		.querySelectorAll('.slider-block-boxed-carousel.splide')
		.forEach((el) => {
			initBoxedCarouselArrowsSlider(el);
		});

	// Initialize Posts Carousel Full Width slider.
	document
		.querySelectorAll('.slider-block-posts-carousel-full.splide')
		.forEach((el) => {
			initPostsCarouselFull(el);
		});
});
