import Splide from '@splidejs/splide';

const getResponsivePerPage = (el) => {
	const mobile = parseFloat(el.dataset.itemsMobile || '1');
	const tablet = parseFloat(el.dataset.itemsTablet || '2');
	const desktop = parseFloat(el.dataset.itemsDesktop || '4');

	return {
		breakpoints: {
			1200: { perPage: tablet, gap: '1rem', padding: 0 },
			780: { perPage: mobile, gap: '1rem', padding: 0 },
		},
		perPage: desktop,
		gap: '1rem',
		padding: { right: '1rem' }, // Add padding to show peek of next slide
	};
};

export const initBoxedCarouselArrowsSlider = (rootElement) => {
	const responsiveSettings = getResponsivePerPage(rootElement);
	const isEditor = !!document.querySelector('.wp-block-editor__container');

	const config = {
		type: rootElement.dataset.type || 'slide',
		perPage: responsiveSettings.perPage,
		arrows: rootElement.dataset.arrows === 'true',
		pagination: rootElement.dataset.pagination === 'true',
		gap: responsiveSettings.gap,
		padding: responsiveSettings.padding,
		speed: 500,
		trimSpace: false, // Prevents trimming empty space
		cloneStatus: true, // Shows cloned slides in the editor
		updateOnMove: true, // Updates classes during transitions
		breakpoints: responsiveSettings.breakpoints,
		drag: !isEditor, // Disable drag in editor
	};

	if (rootElement.dataset.autoplay === 'true') {
		config.autoplay = {
			delay: parseInt(rootElement.dataset.interval || '3000', 10),
			pauseOnHover: true,
		};
	}

	if (config.type === 'slide') {
		config.rewind = rootElement.dataset.rewind === 'true';
	}

	const splide = new Splide(rootElement, config);
	splide.mount();
};

export default initBoxedCarouselArrowsSlider;
