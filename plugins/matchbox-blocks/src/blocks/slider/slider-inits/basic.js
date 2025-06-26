/**
 * Initialize Slider with settings.
 */
import Splide from '@splidejs/splide';

export const initBasicSlider = (rootElement) => {
	const config = {
		type: rootElement.dataset.type || 'slide',
		perPage: 1,
		arrows: rootElement.dataset.arrows === 'true',
		pagination: rootElement.dataset.pagination === 'true',
		speed: 500,
		autoplay: rootElement.dataset.autoplay === 'true',
		interval: parseInt(rootElement.dataset.interval || '3000', 10),
		pauseOnHover: true,
		pauseOnFocus: true,
		updateOnMove: true,
		waitForTransition: true,
	};

	if (config.type !== 'slide') {
		delete config.rewind;
	} else {
		config.rewind = rootElement.dataset.rewind === 'true';
	}

	const splide = new Splide(rootElement, config);
	splide.mount();
};

export default initBasicSlider;
