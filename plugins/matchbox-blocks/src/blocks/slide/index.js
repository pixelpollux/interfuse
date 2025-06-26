import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import save from './save';
import edit from './edit';

registerBlockType(metadata.name, {
	edit,
	save,
});
