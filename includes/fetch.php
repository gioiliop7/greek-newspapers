<?php
    // Get the current date in the format YYYYMMDD
    $current_date = date('Ymd');
    // Fetch the images from the API
    $response = wp_remote_get('https://protoselida.24media.gr/public/json/widget?widgetId=3&date=' . $current_date);
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);
    return $data;
?>
