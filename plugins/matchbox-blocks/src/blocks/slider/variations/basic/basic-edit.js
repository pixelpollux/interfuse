import {
	useBlockProps,
	BlockControls,
	InnerBlocks,
	InspectorControls,
	PanelColorSettings,
} from '@wordpress/block-editor';
import { useEffect } from '@wordpress/element';
import SlideHeader from '../../components/SlideHeader';
import SlideControls from '../../components/SlideControls';
import { useSelect } from '@wordpress/data';
import {
	PanelBody,
	SelectControl,
	ToggleControl,
	TextControl,
	Card,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes, clientId }) {
	const {
		sliderType,
		autoplay,
		interval,
		rewind,
		arrows,
		pagination,
		arrowColor,
		arrowHoverColor,
		paginationInactiveColor,
		paginationActiveColor,
		paginationActiveHoverColor,
		activeBlockIndex = 0,
		sliderAlign = '',
	} = attributes;

	const blockProps = useBlockProps({
		className: `slider-block-basic ${sliderAlign}`,
	});

	const innerBlocks = useSelect(
		(select) => select('core/block-editor').getBlocks(clientId),
		[clientId],
	);

	const numOfBlocks = innerBlocks?.length || 0;

	const handlePrev = () => {
		const newIndex =
			activeBlockIndex === 0 ? numOfBlocks - 1 : activeBlockIndex - 1;
		setAttributes({ activeBlockIndex: newIndex });
	};

	const handleNext = () => {
		const newIndex =
			activeBlockIndex === numOfBlocks - 1 ? 0 : activeBlockIndex + 1;
		setAttributes({ activeBlockIndex: newIndex });
	};

	const handleAdd = () => {
		const { insertBlock } = wp.data.dispatch('core/block-editor');

		const newSlide = wp.blocks.createBlock('matchbox/slide', {}, [
			wp.blocks.createBlock('core/paragraph', {
				placeholder: 'Enter slide content...',
			}),
		]);

		insertBlock(newSlide, undefined, clientId, true);
	};

	useEffect(() => {
		innerBlocks.forEach((block, index) => {
			const editorClass =
				index === activeBlockIndex
					? 'editor-active-block'
					: 'editor-inactive-block';
			const blockClasses = [
				'splide__slide',
				`wp-block-matchbox-slide-editor ${editorClass}`,
			];

			wp.data
				.dispatch('core/block-editor')
				.updateBlockAttributes(block.clientId, {
					className: blockClasses.join(' '),
				});
		});
	}, [innerBlocks, activeBlockIndex]);

	const selectedBlockId = useSelect(
		(select) => select('core/block-editor').getSelectedBlockClientId(),
		[],
	);

	useEffect(() => {
		const selectedIndex = innerBlocks.findIndex(
			(block) => block.clientId === selectedBlockId,
		);
		if (selectedIndex !== -1 && selectedIndex !== activeBlockIndex) {
			setAttributes({ activeBlockIndex: selectedIndex });
		}
	}, [selectedBlockId]);

	return (
		<>
			<InspectorControls>
				<div className="matchbox-slider-styling-panel">
					<PanelBody title="Slider Styling" initialOpen={false}>
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
				<PanelBody title="Slider Settings" initialOpen={true}>
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
					<SelectControl
						label="Slider Type"
						value={sliderType}
						options={[
							{ label: 'Slide', value: 'slide' },
							{ label: 'Loop', value: 'loop' },
							{ label: 'Fade', value: 'fade' },
						]}
						onChange={(value) => setAttributes({ sliderType: value })}
					/>
					{sliderType === 'slide' && (
						<ToggleControl
							label="Rewind"
							help="When enabled, the slider will rewind to the first slide after reaching the last slide."
							checked={rewind}
							onChange={(value) => setAttributes({ rewind: value })}
						/>
					)}
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
					<ToggleControl
						label="Autoplay"
						help="Enable autoplay for the slider."
						checked={autoplay}
						onChange={(value) => setAttributes({ autoplay: value })}
					/>
					{autoplay && (
						<TextControl
							label="Interval (ms)"
							help="Time interval between slides in milliseconds."
							type="number"
							value={interval}
							onChange={(value) =>
								setAttributes({
									interval: parseInt(value, 10),
								})
							}
						/>
					)}
				</PanelBody>
			</InspectorControls>
			<BlockControls>
				<SlideControls
					onAdd={handleAdd}
					onPrev={handlePrev}
					onNext={handleNext}
				/>
			</BlockControls>

			<Card className={`matchbox-slider-editor-wrapper ${sliderAlign}`}>
				<SlideHeader
					clientId={clientId}
					title="Basic Slider"
					activeIndex={activeBlockIndex}
					total={numOfBlocks}
					onAdd={handleAdd}
					onPrev={handlePrev}
					onNext={handleNext}
				/>

				<div {...blockProps}>
					<InnerBlocks allowedBlocks={['core/group']} renderAppender={false} />
				</div>
			</Card>
		</>
	);
}
