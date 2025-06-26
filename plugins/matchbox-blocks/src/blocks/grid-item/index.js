/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
import save from './save';
import metadata from './block.json';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType(metadata.name, {
	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save,

	/**
	 * Block Icon
	 *
	 * Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com
	 * License - https://fontawesome.com/license (Commercial License)
	 * Copyright 2025 Fonticons, Inc.
	 */
	icon: {
		src: (
			<svg
				xmlns="http://www.w3.org/2000/svg"
				viewBox="0 0 448 512"
			>
				<path d="M88 32l24 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L88 64c-30.9 0-56 25.1-56 56l0 24c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-24C0 71.4 39.4 32 88 32zM16 192c8.8 0 16 7.2 16 16l0 96c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-96c0-8.8 7.2-16 16-16zm416 0c8.8 0 16 7.2 16 16l0 96c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-96c0-8.8 7.2-16 16-16zm0-32c-8.8 0-16-7.2-16-16l0-24c0-30.9-25.1-56-56-56l-24 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l24 0c48.6 0 88 39.4 88 88l0 24c0 8.8-7.2 16-16 16zm16 208l0 24c0 48.6-39.4 88-88 88l-24 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l24 0c30.9 0 56-25.1 56-56l0-24c0-8.8 7.2-16 16-16s16 7.2 16 16zM32 368l0 24c0 30.9 25.1 56 56 56l24 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-24 0c-48.6 0-88-39.4-88-88l0-24c0-8.8 7.2-16 16-16s16 7.2 16 16zM176 480c-8.8 0-16-7.2-16-16s7.2-16 16-16l96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-96 0zM160 48c0-8.8 7.2-16 16-16l96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-96 0c-8.8 0-16-7.2-16-16z" />
			</svg>
		),
	},
});
