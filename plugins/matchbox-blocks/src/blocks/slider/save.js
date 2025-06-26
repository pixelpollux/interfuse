import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const {
		sliderType = 'slide',
		arrows = true,
		pagination = true,
		autoplay = false,
		interval = 3000,
		rewind = false,
		sliderAlign = '',
		arrowColor = '',
		arrowHoverColor = '',
		paginationInactiveColor = '',
		paginationActiveColor = '',
		paginationActiveHoverColor = '',
	} = attributes;

	// console.log(attributes);

	const blockProps = useBlockProps.save({
		className:
			`slider-block-basic splide slider-block-basic-${sliderType} ${sliderAlign}`.trim(),
		style: {
			'--arrow-color': arrowColor || undefined,
			'--arrow-hover': arrowHoverColor || undefined,
			'--pagination-inactive-color': paginationInactiveColor || undefined,
			'--pagination-active-color': paginationActiveColor || undefined,
			'--pagination-active-hover-color':
				paginationActiveHoverColor || undefined,
		},
		'data-type': sliderType,
		'data-arrows': String(arrows),
		'data-pagination': String(pagination),
		'data-autoplay': String(autoplay),
		'data-interval': interval,
		'data-rewind': String(rewind),
	});

	// console.log(blockProps);

	return (
		<div {...blockProps}>
			<div className="splide__track">
				<ul className="splide__list">
					<InnerBlocks.Content />
				</ul>
			</div>
		</div>
	);
}
