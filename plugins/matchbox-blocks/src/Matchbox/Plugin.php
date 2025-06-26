<?php
/**
 * Plugin class for Matchbox Blocks.
 *
 * @since 1.0.0
 *
 * @package MatchboxBlocks
 */

namespace Matchbox;

/**
 * Main plugin class.
 *
 * @since 1.0.0
 *
 * @package MatchboxBlocks
 */
class Plugin {
	/**
	 * Reference to the Assets manager.
	 *
	 * @var Assets
	 */
	private $assets;

	/**
	 * Constructor to initialize the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		// Copy ACF render templates into build/ if needed
		$this->copy_acf_render_templates();

		// Load helpers
		require_once plugin_dir_path( dirname( __DIR__ ) ) . 'src/acf-blocks.php';

		// Continue init
		$this->init_hooks();
		$this->assets = new Assets();
		$this->assets->init();
	}

	/**
	 * Initialize WordPress hooks.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function init_hooks() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		add_action( 'acf/init', [ $this, 'register_acf_blocks' ] );
	}

	/**
	 * Register all blocks defined in the build/blocks directory.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_blocks() {
		$block_folders = glob( plugin_dir_path( dirname( __DIR__ ) ) . 'build/blocks/*', GLOB_ONLYDIR );

		error_log( 'Matchbox Blocks: Found ' . count( $block_folders ) . ' block folders' );

		foreach ( $block_folders as $block_folder ) {
			error_log( 'Matchbox Blocks: Checking folder: ' . $block_folder );

			$block_json_path = $block_folder . '/block.json';

			if ( file_exists( $block_json_path ) ) {
				$block_json = json_decode( file_get_contents( $block_json_path ), true );

				if ( isset( $block_json['acf'] ) && is_array( $block_json['acf'] ) ) {
					error_log( 'Matchbox Blocks: Skipping ACF block: ' . $block_json['name'] );
					continue;
				}

				error_log( 'Matchbox Blocks: Registering native block: ' . $block_folder );
				register_block_type( $block_folder );
			}
		}
	}

	public function register_acf_blocks() {
		$block_folders = glob( plugin_dir_path( dirname( __DIR__ ) ) . 'build/blocks/*', GLOB_ONLYDIR );

		foreach ( $block_folders as $block_folder ) {
			$block_json_path = $block_folder . '/block.json';

			if ( file_exists( $block_json_path ) ) {
				$block_json = json_decode( file_get_contents( $block_json_path ), true );

				if ( isset( $block_json['acf'] ) && is_array( $block_json['acf'] ) ) {
					$acf_args = array_merge(
						$block_json,
						$block_json['acf'],
						[
							'render_template' => $block_folder . '/' . $block_json['acf']['renderTemplate'],
						]
					);

					unset( $acf_args['acf'] );

					if ( function_exists( 'acf_register_block_type' ) && ! acf_get_block_type( $acf_args['name'] ) ) {
						error_log( 'Matchbox ACF Block: Registering ' . $acf_args['name'] );
						acf_register_block_type( $acf_args );
					}
				}
			}
		}
	}

	private function copy_acf_render_templates() {
		$src_blocks_path   = plugin_dir_path( dirname( __DIR__ ) ) . 'src/blocks/';
		$build_blocks_path = plugin_dir_path( dirname( __DIR__ ) ) . 'build/blocks/';

		$block_folders = glob( $src_blocks_path . '*', GLOB_ONLYDIR );

		foreach ( $block_folders as $src_folder ) {
			$block_name     = basename( $src_folder );
			$render_php_src = $src_folder . '/' . $block_name . '.php';
			$render_php_dst = $build_blocks_path . $block_name . '/' . $block_name . '.php';

			if ( file_exists( $render_php_src ) ) {
				if ( ! file_exists( dirname( $render_php_dst ) ) ) {
					mkdir( dirname( $render_php_dst ), 0755, true );
				}
				copy( $render_php_src, $render_php_dst );
				error_log( "✅ Copied {$block_name}.php to build/blocks/{$block_name}/" );
			}
		}
	}


	/**
	 * Code to run on plugin activation.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function activate() {
		// Code to run on plugin activation.
	}

	/**
	 * Code to run on plugin deactivation.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function deactivate() {
		// Code to run on plugin deactivation.
	}
}
