<?php
/**
 * Plugin Name: Matchbox Blocks
 * Description: Custom blocks and extensions built by the Matchbox team.
 * Version: 1.0.0
 * Author: Matchbox Team
 * Text Domain: matchbox
 * Domain Path: /languages
 * Namespace: matchbox
 *
 * @package MatchboxBlocks
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/blocks/slider/enqueue.php';
require_once __DIR__ . '/src/acf-blocks.php';

use Matchbox\Plugin;

/**
 * Initialize the Matchbox Blocks plugin.
 */
function matchbox_blocks_init() {
	$plugin = new Plugin();
}

add_action( 'plugins_loaded', 'matchbox_blocks_init' );

register_activation_hook( __FILE__, [ 'Matchbox\\Plugin', 'activate' ] );
register_deactivation_hook( __FILE__, [ 'Matchbox\\Plugin', 'deactivate' ] );
