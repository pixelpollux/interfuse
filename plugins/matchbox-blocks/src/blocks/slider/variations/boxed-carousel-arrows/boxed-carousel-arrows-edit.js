import {
	useBlockProps,
	InspectorControls,
	PanelColorSettings,
} from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { useRef, useEffect } from '@wordpress/element';
import {
	PanelBody,
	ToggleControl,
	TextControl,
	SelectControl,
} from '@wordpress/components';
import { useEntityRecords } from '@wordpress/core-data';
import { __ } from '@wordpress/i18n';
import Splide from '@splidejs/splide';

export default function Edit({ attributes, setAttributes }) {
	const {
		autoplay,
		interval,
		rewind,
		arrows,
		arrowsPosition,
		gap,
		padding,
		pagination,
		arrowColor,
		arrowHoverColor,
		paginationInactiveColor,
		paginationActiveColor,
		paginationActiveHoverColor,
		postType,
		postsToShow,
		postsPicker,
		itemsMobile,
		itemsTablet,
		itemsDesktop,

		sliderAlign = '',
	} = attributes;

	const blockProps = useBlockProps({
		className: `slider-block-boxed-carousel ${sliderAlign}`,
	});

	const postTypes = useSelect((select) => {
		const types = select('core').getPostTypes({
			per_page: -1,
		});

		return types?.filter(
			(type) =>
				type.slug !== 'attachment' &&
				(type.slug === 'post' ||
					(type.viewable && !type.slug.startsWith('wp_'))),
		);
	}, []);

	const { records: posts, isResolving } = useEntityRecords(
		'postType',
		postType,
		{
			per_page: postsToShow,
			_embed: true,
		},
	);

	useEffect(() => {
		if (sliderRef.current && posts?.length) {
			const splide = new Splide(sliderRef.current, {
				type: 'slide',
				perPage: itemsDesktop || 3,
				arrows: true,
				pagination: false,
				gap: '1rem',
				padding: { right: '1rem', left: '1rem' },
				focus: 'center',
				trimSpace: true,
				updateOnMove: true,
			});

			splide.mount();

			// Optional: destroy on unmount
			return () => splide.destroy();
		}
	}, [posts, itemsDesktop]);

	const sliderRef = useRef();

	return (
		<>
			<InspectorControls>
				<div className="matchbox-slider-styling-panel">
					<PanelBody
						title={__('Slider Styling', 'matchbox')}
						initialOpen={false}
					>
						<PanelColorSettings
							title="Arrow & Pagination Colors"
							colorSettings={[
								{
									value: arrowColor,
									onChange: (value) => setAttributes({ arrowColor: value }),
									label: 'Arrow Color',
								},
								{
									value: arrowHoverColor,
									onChange: (value) =>
										setAttributes({
											arrowHoverColor: value,
										}),
									label: 'Arrow Hover Color',
								},
								{
									value: paginationInactiveColor,
									onChange: (value) =>
										setAttributes({
											paginationInactiveColor: value,
										}),
									label: 'Pagination Inactive Color',
								},
								{
									value: paginationActiveColor,
									onChange: (value) =>
										setAttributes({
											paginationActiveColor: value,
										}),
									label: 'Pagination Active Color',
								},
								{
									value: paginationActiveHoverColor,
									onChange: (value) =>
										setAttributes({
											paginationActiveHoverColor: value,
										}),
									label: 'Pagination Active Hover Color',
								},
							]}
						/>
					</PanelBody>
				</div>
				<PanelBody title={__('Slider Settings', 'matchbox')} initialOpen={true}>
					<SelectControl
						label="Slider Width"
						value={sliderAlign}
						options={[
							{ label: 'Default', value: '' },
							{ label: 'Wide', value: 'alignwide' },
							{ label: 'Full Width', value: 'alignfull' },
						]}
						onChange={(value) => setAttributes({ sliderAlign: value })}
					/>
					<ToggleControl
						label="Rewind"
						help="When enabled, the slider will rewind to the first slide after reaching the last slide."
						checked={rewind}
						onChange={(value) => setAttributes({ rewind: value })}
					/>
					<ToggleControl
						label="Pagination"
						help="Show pagination dots below the slider."
						checked={pagination}
						onChange={(value) => setAttributes({ pagination: value })}
					/>
					<ToggleControl
						label="Arrows"
						help="Show navigation arrows on the slider."
						checked={arrows}
						onChange={(value) => setAttributes({ arrows: value })}
					/>
					{arrows && (
						<SelectControl
							label={__('Arrows Position', 'matchbox')}
							value={arrowsPosition}
							options={[
								{ label: 'Default', value: 'outside' },
								{ label: 'Bottom', value: 'bottom' },
								{ label: 'Bottom Left', value: 'bottom-left' },
								{ label: 'Bottom Middle', value: 'bottom-middle' },
								{ label: 'Bottom Right', value: 'bottom-right' },
								{ label: 'Top', value: 'top' },
								{ label: 'Top Left', value: 'top-left' },
								{ label: 'Top Middle', value: 'top-middle' },
								{ label: 'Top Right', value: 'top-right' },
							]}
							onChange={(val) => setAttributes({ postType: val })}
						/>
					)}
					<ToggleControl
						label={__('Autoplay', 'matchbox')}
						help={__('Enable autoplay for the slider.', 'matchbox')}
						checked={autoplay}
						onChange={(value) => setAttributes({ autoplay: value })}
					/>
					{autoplay && (
						<TextControl
							label={__('Interval (ms)', 'matchbox')}
							help={__(
								'Time interval between slides in milliseconds.',
								'matchbox',
							)}
							type="number"
							value={interval}
							onChange={(value) =>
								setAttributes({ interval: parseInt(value, 10) })
							}
						/>
					)}
					<TextControl
						label={__('Items (≤ 525px)', 'matchbox')}
						type="number"
						value={itemsMobile}
						onChange={(val) =>
							setAttributes({ itemsMobile: parseInt(val, 10) })
						}
					/>
					<TextControl
						label={__('Items (≤ 781px)', 'matchbox')}
						type="number"
						value={itemsTablet}
						onChange={(val) =>
							setAttributes({ itemsTablet: parseInt(val, 10) })
						}
					/>
					<TextControl
						label={__('Items (≤ 1200px)', 'matchbox')}
						type="number"
						value={itemsDesktop}
						onChange={(val) =>
							setAttributes({ itemsDesktop: parseInt(val, 10) })
						}
					/>
					<TextControl
						label={__('Gap', 'matchbox')}
						type="number"
						value={gap}
						onChange={(val) => setAttributes({ gap: parseInt(val, 24) })}
					/>
					<TextControl
						label={__('Outside Padding', 'matchbox')}
						type="number"
						value={padding}
						onChange={(val) => setAttributes({ padding: parseInt(val, 0) })}
					/>
					<SelectControl
						label={__('Post Type', 'matchbox')}
						value={postType}
						options={
							postTypes
								? postTypes.map((type) => ({
										label: type.labels?.singular_name || type.name,
										value: type.slug,
									}))
								: [
										{
											label: __('Loading…', 'matchbox'),
											value: '',
										},
									]
						}
						onChange={(val) => setAttributes({ postType: val })}
					/>
					<SelectControl
						label={__('Choose Which Posts To Display', 'matchbox')}
						value={postsPicker}
						options={[
							{ label: __('Most Recent', 'matchbox'), value: 'most-recent' },
							{ label: __('Manual', 'matchbox'), value: 'manual' },
						]}
						onChange={(val) => setAttributes({ postsPicker: val })}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...blockProps}>
				<div ref={sliderRef} className="splide">
					<div className="splide__track">
						<ul className="splide__list">
							{isResolving && (
								<li className="splide__slide">{__('Loading…', 'matchbox')}</li>
							)}

							{!isResolving &&
								posts?.map((post) => {
									const title =
										post.title?.rendered || __('(no title)', 'matchbox');
									const featuredMedia =
										post._embedded?.['wp:featuredmedia']?.[0];
									const imageUrl = featuredMedia?.source_url;

									return (
										<li
											key={post.id}
											className="splide__slide wp-block-matchbox-slide editor-preview-slide"
										>
											<div className="slide-content">
												{imageUrl && (
													<div className="slide-content__image">
														<img
															src={imageUrl}
															alt={featuredMedia?.alt_text || title}
														/>
													</div>
												)}

												<p
													className="slide-content__title"
													style={{
														fontWeight: '600',
														fontSize: '1.25rem',
													}}
													dangerouslySetInnerHTML={{
														__html: title,
													}}
												></p>
											</div>
										</li>
									);
								})}
						</ul>
					</div>
				</div>
			</div>
		</>
	);
}
