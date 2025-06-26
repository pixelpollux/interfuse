<?php

// Namespace the file
namespace StyledCalendar;

// If this file is called directly, abort
defined('ABSPATH') or die;

// Set up admin-facing scripts and styles with cache busting on plugin version updates
add_action('admin_enqueue_scripts', function() {
  global $styled_calendar_plugin_version;
  wp_register_script('styled-calendar-admin', plugin_dir_url(__FILE__) . '../client/index.js', [], $styled_calendar_plugin_version, true);
  wp_register_style('styled-calendar-admin', plugin_dir_url(__FILE__) . '../client/index.css', [], $styled_calendar_plugin_version, 'all');
});

// Localize data for use on the client side
add_action('admin_enqueue_scripts', function() {
  $data_to_localize = [
    'restBaseUrl' => get_rest_url(null, 'styled-calendar'), // The URL through which the client will call the WP REST API endpoints
    'restNonce' => wp_create_nonce('wp_rest'), // The nonce that the client will use to call the WP REST API endpoints
    'connected' => (get_option('styled_calendar_api_key') != null) ? 'true' : 'false', // Whether WordPress is connected to a Styled Calendar account
    'styledCalendarUrl' => getenv('STYLED_CALENDAR_URL') ?: 'https://app.styledcalendar.com', // The base URL for the main Styled Calendar app
    'styledCalendarEmbedUrl' => getenv('STYLED_CALENDAR_EMBED_URL') ?: 'https://embed.styledcalendar.com', // The base URL for Styled Calendar embeds
    'styledCalendarParentScriptFullUrl' => getenv('STYLED_CALENDAR_PARENT_SCRIPT_FULL_URL') ?: 'https://embed.styledcalendar.com/assets/parent-window.js' // The URL of the parent script references in the HTML embed snippet
  ];
  wp_localize_script("styled-calendar-admin", 'styledCalendarLocalizedData', $data_to_localize);
}, 15);

// Add main menu page
add_action('admin_menu', function() {
  add_menu_page(
    // Page title
    'Styled Calendar',

    // Menu title
    'Styled Calendar',

    // Capability (required permissions level to edit) only for users with access to administration screens: https://wordpress.org/support/article/roles-and-capabilities/#manage_options
    'manage_options',

    // Slug
    'styled-calendar',
    
    // Callback (used to generate page content and enqueue styles and scripts)
    function () {
      // Pull in the styles and scripts
      wp_enqueue_script('styled-calendar-admin');
      wp_enqueue_style('styled-calendar-admin');

      // Create a container for the Vue app to be mounted into
      echo '<div id="styled-calendar-container"></div>';
    },

    // Base 64 encoded menu icon (can be created here: https://base64.guru/converter/encode/image/svg -- use "Data URI -- data:content/type;base64" output format)
    'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhLS0gQ3JlYXRlZCB3aXRoIElua3NjYXBlIChodHRwOi8vd3d3Lmlua3NjYXBlLm9yZy8pIC0tPgoKPHN2ZwogICB3aWR0aD0iMTJtbSIKICAgaGVpZ2h0PSIxMm1tIgogICB2aWV3Qm94PSIwIDAgMTIgMTIiCiAgIHZlcnNpb249IjEuMSIKICAgaWQ9InN2ZzMwNyIKICAgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIgogICB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8ZGVmcwogICAgIGlkPSJkZWZzMzA0Ij4KICAgIDxyZWN0CiAgICAgICB4PSI2Ni4zMjEzNzMiCiAgICAgICB5PSI0MS4zNjI5NzIiCiAgICAgICB3aWR0aD0iNTE0Ljg2NzEzIgogICAgICAgaGVpZ2h0PSI0MjQuMTIyNDEiCiAgICAgICBpZD0icmVjdDQ4MiIgLz4KICA8L2RlZnM+CiAgPGcKICAgICBpZD0ibGF5ZXIxIgogICAgIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xNy4wNjA3OTIsLTEwLjg1OTgxMikiPgogICAgPGcKICAgICAgIGFyaWEtbGFiZWw9IlMiCiAgICAgICB0cmFuc2Zvcm09InNjYWxlKDAuMjY0NTgzMzMpIgogICAgICAgaWQ9InRleHQ0ODAiCiAgICAgICBzdHlsZT0iZm9udC1zaXplOjQwcHg7bGluZS1oZWlnaHQ6MS4yNTtmb250LWZhbWlseTpTYXRpc2Z5Oy1pbmtzY2FwZS1mb250LXNwZWNpZmljYXRpb246U2F0aXNmeTt3aGl0ZS1zcGFjZTpwcmU7c2hhcGUtaW5zaWRlOnVybCgjcmVjdDQ4Mik7ZmlsbDojM2Y0MjAwIj4KICAgICAgPHBhdGgKICAgICAgICAgZD0ibSA5Mi41MjM2MSw1Ni44MTU3MjUgcSAtMC4wMzkwNiwtMC4xMTcxODggMC4yMzQzNzUsLTAuNTg1OTM4IDAuMjczNDM4LC0wLjUwNzgxMiAwLjU4NTkzOCwtMS4yMTA5MzcgMC4zNTE1NjIsLTAuNzQyMTg4IDAuNjY0MDYyLC0xLjY0MDYyNSAwLjM1MTU2MywtMC45Mzc1IDAuNDY4NzUsLTEuOTE0MDYzIDAuMTU2MjUsLTAuOTc2NTYyIDAsLTEuOTUzMTI1IC0wLjE1NjI1LC0wLjk3NjU2MiAtMC44MjAzMTIsLTEuODc1IC0wLjM5MDYyNSwtMC40Njg3NSAtMS4xNzE4NzUsLTAuNTA3ODEyIC0wLjc0MjE4OCwtMC4wNzgxMyAtMS43MTg3NSwwLjIzNDM3NSAtMC45Mzc1LDAuMjczNDM3IC0xLjk5MjE4OCwwLjg5ODQzNyAtMS4wMTU2MjUsMC41ODU5MzggLTEuODc1LDEuNDA2MjUgLTAuODU5Mzc1LDAuNzgxMjUgLTEuNDg0Mzc1LDEuNzU3ODEzIC0wLjU4NTkzNywwLjk3NjU2MiAtMC42NjQwNjIsMS45OTIxODcgLTAuMDc4MTMsMC44MjAzMTMgMC4wMzkwNiwxLjUyMzQzOCAwLjE1NjI1LDAuNzAzMTI1IDAuMzkwNjI1LDEuMjg5MDYyIDAuMjM0Mzc1LDAuNTg1OTM4IDAuNTA3ODEzLDEuMDkzNzUgMC4yNzM0MzcsMC41MDc4MTMgMC41MDc4MTIsMC44OTg0MzggMC4zMTI1LDAuNTQ2ODc1IDAuOTc2NTYzLDEuMjEwOTM3IDAuNjY0MDYyLDAuNjY0MDYzIDEuNDQ1MzEyLDEuNTIzNDM4IDAuNzgxMjUsMC44MjAzMTIgMS41NjI1LDEuODc1IDAuNzgxMjUsMS4wNTQ2ODcgMS4zNjcxODgsMi4zODI4MTIgMC41ODU5MzcsMS4zMjgxMjUgMC44MjAzMTIsMi45Njg3NSAwLjIzNDM3NSwxLjY0MDYyNSAtMC4wMzkwNiwzLjYzMjgxMyAtMC40Mjk2ODgsMi44OTA2MjUgLTEuMzY3MTg4LDQuODA0Njg3IC0wLjkzNzUsMS45NTMxMjUgLTIuMDcwMzEyLDMuMTI1IC0xLjA5Mzc1LDEuMTcxODc1IC0yLjIyNjU2MywxLjY3OTY4OCAtMS4xMzI4MTIsMC41NDY4NzUgLTEuODc1LDAuNzAzMTI1IC0wLjU4NTkzNywwLjExNzE4NyAtMS40MDYyNSwwLjE5NTMxMiAtMC43ODEyNSwwLjExNzE4OCAtMS42Nzk2ODcsLTAuMDM5MDYgLTAuODU5Mzc1LC0wLjExNzE4OCAtMS43NTc4MTMsLTAuNTQ2ODc1IC0wLjg5ODQzNywtMC4zOTA2MjUgLTEuNjAxNTYyLC0xLjI1IC0wLjgyMDMxMywtMC45NzY1NjMgLTEuMjg5MDYzLC0yLjEwOTM3NSAtMC40Mjk2ODcsLTAuOTc2NTYzIC0wLjYyNSwtMi4yNjU2MjUgLTAuMjM0Mzc1LC0xLjI1IDAuMTk1MzEzLC0yLjYxNzE4OCAwLjMxMjUsLTAuMzUxNTYyIDAuNjY0MDYyLC0wLjYyNSAwLjM1MTU2MywtMC4yNzM0MzcgMC43MDMxMjUsLTAuNDY4NzUgMC4zOTA2MjUsLTAuMjM0Mzc1IDAuODIwMzEzLC0wLjQyOTY4NyAwLjUwNzgxMiwtMC4xNTYyNSAxLjAxNTYyNSwtMC4yNzM0MzggMC40Mjk2ODcsLTAuMDc4MTMgMC44OTg0MzcsLTAuMDc4MTMgMC41MDc4MTMsLTAuMDM5MDYgMC45Mzc1LDAuMTE3MTg4IC0wLjU4NTkzNywwLjY2NDA2MiAtMC44MjAzMTIsMS4yNSAtMC4xNTYyNSwwLjMxMjUgLTAuMjM0Mzc1LDAuNTQ2ODc1IC0wLjE1NjI1LDAuNzQyMTg3IC0wLjExNzE4OCwxLjc1NzgxMiAwLjA3ODEzLDEuMDU0Njg4IDAuNDI5Njg4LDEuOTkyMTg4IDAuMzkwNjI1LDAuOTc2NTYyIDEuMDkzNzUsMS42NDA2MjUgMC43MDMxMjUsMC43MDMxMjUgMS44NzUsMC43NDIxODcgMi44NTE1NjIsMC4wNzgxMyA0Ljg0Mzc1LC00LjQ1MzEyNSAwLjY2NDA2MiwtMS40MDYyNSAwLjY2NDA2MiwtMi44NTE1NjIgMC4wMzkwNiwtMS40NDUzMTMgLTAuMzUxNTYyLC0yLjc3MzQzOCAtMC4zNTE1NjMsLTEuMzI4MTI1IC0wLjk3NjU2MywtMi40NjA5MzcgLTAuNTg1OTM3LC0xLjE3MTg3NSAtMS4yMTA5MzcsLTEuOTkyMTg4IC0wLjYyNSwtMC44MjAzMTIgLTEuNTIzNDM4LC0xLjc1NzgxMiAtMC44NTkzNzUsLTAuOTc2NTYzIC0xLjcxODc1LC0yLjEwOTM3NSAtMC44NTkzNzUsLTEuMTMyODEzIC0xLjU2MjUsLTIuNDYwOTM4IC0wLjY2NDA2MiwtMS4zMjgxMjUgLTAuODk4NDM3LC0yLjg5MDYyNSAtMC4zMTI1LC0yLjE4NzUgMC4zOTA2MjUsLTMuOTg0Mzc1IDAuNzQyMTg3LC0xLjgzNTkzNyAxLjk1MzEyNSwtMy4yMDMxMjUgMS4yNSwtMS4zNjcxODcgMi42OTUzMTIsLTIuMjI2NTYyIDEuNDg0Mzc1LC0wLjg1OTM3NSAyLjYxNzE4OCwtMS4wOTM3NSA2LjI4OTA2MiwtMS4yNSA4LjI0MjE4NywyLjEwOTM3NSAwLjgyMDMxMywxLjI4OTA2MiAwLjg5ODQzOCwyLjczNDM3NSAwLjA3ODEzLDEuNDQ1MzEyIC0wLjE5NTMxMywyLjY5NTMxMiAtMC4yMzQzNzUsMS4yMTA5MzggLTAuNjI1LDIuMDcwMzEzIC0wLjM1MTU2MiwwLjgyMDMxMiAtMC40Njg3NSwwLjg5ODQzNyAtMC4yMzQzNzUsMC4yMzQzNzUgLTAuNzQyMTg3LDAuNTA3ODEzIC0wLjUwNzgxMywwLjI3MzQzNyAtMS42NDA2MjUsMC41MDc4MTIgLTAuMzEyNSwwLjA3ODEzIC0wLjYyNSwwLjA3ODEzIC0wLjI3MzQzOCwwIC0wLjU4NTkzOCwtMC4wMzkwNiAtMC4zMTI1LC0wLjAzOTA2IC0wLjU0Njg3NSwtMC4xNTYyNSB6IgogICAgICAgICBzdHlsZT0iZmlsbDojZmZmZmZmO2ZpbGwtb3BhY2l0eToxIgogICAgICAgICBpZD0icGF0aDE4MTYiIC8+CiAgICA8L2c+CiAgPC9nPgo8L3N2Zz4K', 
    
    // Menu position
    80
  );
});

// Prevent WP admin notices on the plugin page
add_action('in_admin_header', function() {
  // If the current page is not this plugin's settings page, return and do nothing
  if(($_REQUEST["page"] ?? null) !== "styled-calendar") return;

  // If the current page is this plugin's settings page, remove all WordPress notices
  remove_all_actions("network_admin_notices");
  remove_all_actions("user_admin_notices");
  remove_all_actions("admin_notices");
  remove_all_actions("all_admin_notices");
});