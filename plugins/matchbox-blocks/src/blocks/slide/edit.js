import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps({
		className: 'splide__slide',
		tagName: 'li',
	});

	return (
		<li {...blockProps}>
			<InnerBlocks
			// allowedBlocks={['core/paragraph', 'core/image', 'core/heading']}
			/>
		</li>
	);
}
