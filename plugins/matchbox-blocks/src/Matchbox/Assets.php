<?php
/**
 * Handle script and style enqueues for Matchbox Blocks.
 *
 * @package MatchboxBlocks
 *
 * @since 1.0.0
 */

namespace Matchbox;

/**
 * Class Assets
 *
 * Handle script and style enqueues for Matchbox Blocks.
 *
 * @package MatchboxBlocks
 *
 * @since 1.0.0
 */
class Assets {
	/**
	 * Initialize hooks for enqueuing assets.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor_assets' ] );

		// If you have front-end scripts or styles, use wp_enqueue_scripts or enqueue_block_assets.
		// add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_assets' ] );.
	}

	/**
	 * Enqueue scripts/styles for the block editor.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_editor_assets() {
		// Enqueue each block's build files individually.
		$this->enqueue_block_asset( 'grid-item', 'matchbox-grid-item' );
		$this->enqueue_block_asset( 'pattern-library-block', 'matchbox-pattern-library-block' );
		$this->enqueue_block_asset( 'slider', 'matchbox-slider' );
	}

	/**
	 * Helper function to enqueue a single block's build files based on its folder name.
	 *
	 * @since 1.0.0
	 *
	 * @param string $folder_name  The folder name in build/blocks (e.g. 'block-1').
	 * @param string $handle       A unique script handle for WordPress (e.g. 'matchbox-block-1').
	 *
	 * @return void
	 */
	private function enqueue_block_asset( $folder_name, $handle ) {
		$asset_file = plugin_dir_path( __DIR__ ) . 'build/blocks/' . $folder_name . '/index.asset.php';
		$script_url = plugin_dir_url( __DIR__ ) . 'build/blocks/' . $folder_name . '/index.js';

		if ( file_exists( $asset_file ) ) {
			$asset = include $asset_file;

			wp_enqueue_script(
				$handle,
				$script_url,
				isset( $asset['dependencies'] ) ? $asset['dependencies'] : [],
				isset( $asset['version'] ) ? $asset['version'] : filemtime( $script_url ),
				true
			);

			// If you have a separate CSS file for editor styles, enqueue it here.
			$editor_style = plugin_dir_url( __DIR__ ) . 'build/blocks/' . $folder_name . '/index.css';

			if ( file_exists( plugin_dir_path( __DIR__ ) . 'build/blocks/' . $folder_name . '/index.css' ) ) {
				wp_enqueue_style(
					$handle . '-editor',
					$editor_style,
					[],
					filemtime( plugin_dir_path( __DIR__ ) . 'build/blocks/' . $folder_name . '/index.css' )
				);
			}
		}
	}

	/**
	 * Enqueue front-end assets for the block.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_frontend_assets() {
		// Example: If each block also needs front-end CSS or JS, do a similar approach here.
	}
}
