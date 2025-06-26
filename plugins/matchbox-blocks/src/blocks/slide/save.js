import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

export default function save() {
	return (
		<li
			{...useBlockProps.save({
				className: 'splide__slide',
			})}
		>
			<InnerBlocks.Content />
		</li>
	);
}
