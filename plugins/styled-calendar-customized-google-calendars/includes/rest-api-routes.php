<?php

// Namespace the file
namespace StyledCalendar;

// If this file is called directly, abort
defined('ABSPATH') or die;

// Add a route to the WP REST API that allows the client to set the Styled Calendar UID and API key within options
add_action('rest_api_init', function() {
  register_rest_route(
    'styled-calendar',
    '/credentials',
    [
      'methods' => 'PUT',
      'callback' => function(\WP_REST_Request $request) {
        // Get the API key from the body parameters
        ['apiKey' => $api_key] = $request->get_json_params();

        // Check that the API key is valid (that it's actually connected to a Styled Calendar user)
        $cloudFunctionsBaseUrl = getenv('STYLED_CALENDAR_CLOUD_FUNCTIONS_BASE_URL') ?: 'https://us-central1-styled-calendar-production.cloudfunctions.net'; // The base URL for the app's cloud functions
        $response = wp_remote_get("{$cloudFunctionsBaseUrl}/googleCalendar-apiListStyledCalendars", [ 'headers' => [ 'Authorization' => $api_key ], 'timeout' => 20 ]);
        if (is_wp_error($response)) throw new \Exception("The attempt to validate the Styled Calendar API key failed with the following error message: " . $response->get_error_message());
        
        // If the response from Styled Calendar doesn't indicate success, send a user-facing error back to the client
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code === 401) return new \WP_Error( 'styled_calendar_user_facing_error', 'The API key submitted is not associated with any Styled Calendar account. Please ensure that you generated the API key on app.styledcalendar.com and copied it correctly. If the problem persists, please reach out to Styled Calendar support.', array( 'status' => 403 ) );
        if ($response_code !== 200) return new \WP_Error( 'styled_calendar_user_facing_error', "The API key submission failed with HTTP response code " . strval( $response_code ) . ". Please refresh the page and try again. If the problem persists, please reach out to Styled Calendar support.", array( 'status' => 500 ) );

        // Update the UID and API key in options
        update_option('styled_calendar_api_key', $api_key);
      },
      'permission_callback' => function () {
        // Allow access only for users with access to administration screens: https://wordpress.org/support/article/roles-and-capabilities/#manage_options
        return current_user_can('manage_options');
      },
      // Documentation on adding validation options: https://www.shawnhooper.ca/2017/02/15/wp-rest-secrets-found-reading-core-code/
      'args' => [
        'apiKey' => [
          'required' => true,
          'type' => 'string',
          'description' => 'The API key of the connected Styled Calendar account'
        ]
      ]
    ]
  );
});

// Add a route to the WP REST API that allows the client to delete the Styled Calendar UID and API key from options
add_action('rest_api_init', function() {
  register_rest_route(
    'styled-calendar',
    '/credentials',
    [
      'methods' => 'DELETE',
      'callback' => function(\WP_REST_Request $request) {
        // Delete the UID and API key from options
        delete_option('styled_calendar_api_key');
      },
      'permission_callback' => function () {
        // Allow access only for users with access to administration screens: https://wordpress.org/support/article/roles-and-capabilities/#manage_options
        return current_user_can('manage_options');
      }
    ]
  );
});

// Add a route to the WP REST API that allows the client to fetch the calendar list from Styled Calendar
add_action('rest_api_init', function() {
  register_rest_route(
    'styled-calendar',
    '/calendar-list',
    [
      'methods' => 'GET',
      'callback' => function(\WP_REST_Request $request) {
        // Get the Styled Calendar API key from options
        $api_key = get_option('styled_calendar_api_key');

        // If there is no API key, send a user-facing error to the client
        if ($api_key === null || $api_key === '') return new \WP_Error( 'styled_calendar_user_facing_error', 'The plugin has no saved Styled Calendar API key. Reconnect to Styled Calendar and try again. If the problem persists, please reach out to Styled Calendar support.', array( 'status' => 403 ) );

        // Send a credentialed get request to Styled Calendar's API
        $cloudFunctionsBaseUrl = getenv('STYLED_CALENDAR_CLOUD_FUNCTIONS_BASE_URL') ?: 'https://us-central1-styled-calendar-production.cloudfunctions.net'; // The base URL for the app's cloud functions
        $response = wp_remote_get("{$cloudFunctionsBaseUrl}/googleCalendar-apiListStyledCalendars", [ 'headers' => [ 'Authorization' => $api_key ], 'timeout' => 20 ]);
        
        // Handle any errors from the HTTP request and get the response code
        if (is_wp_error($response)) throw new \Exception("The calendar list query to the Styled Calendar API failed with the following error message: " . $response->get_error_message());
        $response_code = wp_remote_retrieve_response_code($response);

        // If a 401 (unauthorized) response was recieved, send a user-facing error to the client
        if ($response_code === 401) return new \WP_Error( 'styled_calendar_user_facing_error', 'The saved Styled Calendar API key is no longer authorized. Please disconnect WordPress from Styled Calndar, reconnect, and try again. You can disconnect WordPress from Styled Calendar by clicking the user icon in the top right corner. If the problem persists, please reach out to Styled Calendar support.', array( 'status' => 403 ) );

        // If there is another non-200 response code, send a user facing error to the client
        if ($response_code !== 200) throw new \WP_Error( 'styled_calendar_user_facing_error', "While attempting to get the calendar list, the request to the Styled Calendar API failed with HTTP response code ".  strval($response_code) . ". Please refresh the page and try again. If the problem persists, please reach out to Styled Calendar support.", array( 'status' => 500 ) );

        // Extract the response body and handle extraction errors
        $raw_response_body = wp_remote_retrieve_body($response);
        if (is_wp_error($raw_response_body)) throw new \Exception("The calendar list query to the Styled Calendar API failed to decode the server's response with the following error message: " . $raw_response_body->get_error_message());
        $response_body = json_decode($raw_response_body);

        // Return the response
        return $response_body;
      },
      'permission_callback' => function () {
        // Allow access only for users with access to administration screens: https://wordpress.org/support/article/roles-and-capabilities/#manage_options
        return current_user_can('manage_options');
      }
    ]
  );
});
