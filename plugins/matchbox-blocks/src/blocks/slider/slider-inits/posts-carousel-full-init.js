/**
 * Initialize Posts Carousel Full Width Slider with settings.
 */
import Splide from '@splidejs/splide';

export const initPostsCarouselFull = (rootElement) => {
	const config = {
		type: 'loop',
		perPage: 4,
		focus: 'center',
		gap: '2rem',
		autoplay: rootElement.dataset.autoplay === 'true',
		interval: parseInt(rootElement.dataset.interval || '3000', 10),
		pauseOnHover: true,
		pauseOnFocus: true,
		updateOnMove: true,
		waitForTransition: true,
		breakpoints: {
			768: {
				perPage: 1,
			},
			1024: {
				perPage: 2,
			},
		},
	};

	const splide = new Splide(rootElement, config);
	splide.mount();
};

export default initPostsCarouselFull;
