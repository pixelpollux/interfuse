import { getPlugin, registerPlugin } from '@wordpress/plugins';
import { useDispatch } from '@wordpress/data';
import { useShortcut } from '@wordpress/keyboard-shortcuts';
import { useCallback } from '@wordpress/element';

const AddMatchboxLibraryBlock = () => {
	const siteEditor = wp.data.select('core/edit-site');
	const { registerShortcut } = useDispatch(
		'core/keyboard-shortcuts',
	);

	if (undefined === siteEditor) {
		registerShortcut({
			name: 'matchbox-add-library',
			category: 'global',
			description:
				'Inserts the Matchbox Pattern Library block into the editor.',
			keyCombination: {
				modifier: 'ctrl',
				character: 'o',
			},
		});
	}

	useShortcut(
		'matchbox-add-library',
		useCallback(() => {
			// Get currently selected block.
			const selectedBlock = wp.data
				.select('core/block-editor')
				.getSelectedBlock();

			// Set up the block.
			const block = wp.blocks.createBlock(
				'matchbox/pattern-library-block',
			);

			if (null !== selectedBlock) {
				// If the selected block is the Matchbox pattern library block, do nothing.
				if (
					selectedBlock.name ===
					'matchbox/pattern-library-block'
				) {
					return;
				}

				// Get the next index to add the block.
				const nextIndex =
					wp.data
						.select('core/block-editor')
						.getBlockOrder()
						.indexOf(selectedBlock.clientId) + 1;

				// Add the block at the index position.
				wp.data
					.dispatch('core/block-editor')
					.insertBlock(block, nextIndex);
			} else {
				wp.data
					.dispatch('core/block-editor')
					.insertBlock(block);
			}
		}, []),
	);

	return null;
};

if (!getPlugin('matchbox-add-library-shortcut-plugin')) {
	registerPlugin('matchbox-add-library-shortcut-plugin', {
		render: AddMatchboxLibraryBlock,
	});
}
