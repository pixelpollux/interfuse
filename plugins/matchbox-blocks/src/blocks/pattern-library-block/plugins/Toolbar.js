import { ToolbarButton } from '@wordpress/components';
import { render } from '@wordpress/element';
import { getPlugin, registerPlugin } from '@wordpress/plugins';
import { subscribe } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { addTemplate } from '@wordpress/icons';

function Toolbar() {
	const siteEditor = wp.data.select('core/edit-site');

	const LibraryButton = () => (
		<>
			{undefined === siteEditor && (
				<ToolbarButton
					icon={addTemplate}
					className="matchbox-toolbar-button"
					label={__(
						'Matchbox Pattern Library',
						'matchbox-pro',
					)}
					onClick={() => {
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
									.indexOf(selectedBlock.clientId) +
								1;

							// Add the block at the index position.
							wp.data
								.dispatch('core/block-editor')
								.insertBlock(block, nextIndex);
						} else {
							wp.data
								.dispatch('core/block-editor')
								.insertBlock(block);
						}
					}}
				></ToolbarButton>
			)}
		</>
	);
	const renderButton = (selector) => {
		const patternButton = document.createElement('div');
		patternButton.classList.add('matchbox-toolbar-library');
		selector.appendChild(patternButton);
		render(<LibraryButton />, patternButton);
	};

	// Watch for the toolbar to be visible and the design library button to be missing.
	subscribe(() => {
		const editToolbar = document.querySelector(
			'.edit-post-header-toolbar',
		);

		// Bail if the toolbar is not found.
		if (!editToolbar) {
			return;
		}

		// Bail if the button is already rendered.
		if (!editToolbar.querySelector('.matchbox-toolbar-library')) {
			renderButton(editToolbar);
		}
	});

	return null;
}

// Register the plugin.
if (!getPlugin('matchbox-toolbar-library-plugin')) {
	registerPlugin('matchbox-toolbar-library-plugin', {
		render: Toolbar,
	});
}
