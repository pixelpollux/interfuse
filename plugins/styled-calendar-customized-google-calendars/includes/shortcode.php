<?php

// Namespace the file
namespace StyledCalendar;

// If this file is called directly, abort
defined('ABSPATH') or die;

// Add the Styled Calendar shortcode
add_shortcode('styled-calendar', function($atts) {
  // Unpack the attributes
  $attributes = shortcode_atts(array(
    'calendar-id' => '',
  ), $atts);

  // Get the Styled Calendar host and URL and parent script URL if set, otherwise default to the production domain
  $STYLED_CALENDAR_EMBED_URL = getenv('STYLED_CALENDAR_EMBED_URL') ?: 'https://embed.styledcalendar.com';
  $STYLED_CALENDAR_PARENT_SCRIPT_FULL_URL = getenv('STYLED_CALENDAR_PARENT_SCRIPT_FULL_URL') ?: 'https://embed.styledcalendar.com/assets/parent-window.js';

  // Inject the iframe into the page
  return '
    <iframe src="' . esc_url($STYLED_CALENDAR_EMBED_URL . '/#' . $attributes['calendar-id']) . '" title="Styled Calendar" class="styled-calendar-container" style="width: 100%; border: none; visibility: hidden;" onload="this.style.visibility=`visible`;" data-cy="calendar-embed-iframe"></iframe>
    <script async type="module" src="' . esc_url($STYLED_CALENDAR_PARENT_SCRIPT_FULL_URL) . '"></script>
  ';
});