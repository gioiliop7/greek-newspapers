<?php
// Get the current date in the format YYYYMMDD
$current_date = date('Ymd');

// Fetch the images from the API
$url = esc_url_raw('https://protoselida.24media.gr/public/json/widget?widgetId=3&date=' . $current_date);
$response = wp_remote_get($url);

if (is_wp_error($response)) {
    // Handle the error appropriately
    return false;
}

$body = wp_remote_retrieve_body($response);
$data = json_decode(wp_kses_post(wp_unslash($body)));

if (empty($data)) {
    // Handle empty data appropriately
    return false;
}

return $data;
