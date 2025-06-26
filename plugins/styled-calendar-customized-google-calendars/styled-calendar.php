<?php

/**
 * Plugin Name:       Styled Calendar - Customized Google Calendars
 * Plugin URI:        https://styledcalendar.com/?utm_medium=referral&utm_source=wordpress-plugin&utm_campaign=wordpress-plugin
 * Description:       Add a fully customized, mobile-responsive Google Calendar embed to your website in just a few simple clicks - no complex Google Calendar API configuration required.
 * Version:           1.0.20
 * Author:            Styled Calendar
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain:       styled-calendar
 * Requires at least: 5.2
 * Requires PHP:      7.2
 */

// Namespace the file
namespace StyledCalendar;

// If this file is called directly, abort
defined('ABSPATH') or die;

// Set up plugin global variables
$styled_calendar_plugin_version = '1.0.20';

// Require other plugin files
require_once( plugin_dir_path( __FILE__ ) . '/includes/admin-menu.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/rest-api-routes.php');
require_once( plugin_dir_path( __FILE__ ) . '/includes/shortcode.php');

// On uninstall, delete the Styled Calendar credentials from options
function uninstall_styled_calendar() {
  try {
    // Delete the Styled Calendar credentials from options
    delete_option('styled_calendar_api_key');
  } catch (\Throwable $throwable) {
    // Suppress errors when calling error_log and provide a fallback
    @error_log($throwable->getMessage());

    // Fallback: write errors to a custom file if error_log fails and suppress errors here as well
    $error_message = $throwable->getMessage();
    $log_file = plugin_dir_path(__FILE__) . 'uninstall_errors.log';
    @file_put_contents($log_file, '[' . date('Y-m-d H:i:s') . '] ' . $error_message . PHP_EOL, FILE_APPEND);
  }
};
register_uninstall_hook( __FILE__, '\StyledCalendar\uninstall_styled_calendar');