/**
 * External dependencies.
 */
import { getBlockType, registerBlockType } from '@wordpress/blocks';
import { addTemplate } from '@wordpress/icons';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies.
 */
import metadata from './block.json';
import Edit from './Edit';
import Save from './Save';
import './plugins/Toolbar';
import './plugins/Shortcut';

if (!getBlockType('matchbox/pattern-library-block')) {
	registerBlockType(metadata.name, {
		title: __('Matchbox Pattern Library', 'matchbox'),
		icon: addTemplate,
		edit: Edit,
		save: Save,
	});
}
