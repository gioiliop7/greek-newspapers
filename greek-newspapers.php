<?php
/*
Plugin Name: Greek Newspapers
Version: 1.0
Author: Giorgos Iliopoulos
Author URI: https://giorgos-iliopoulos.eu
Description: Display greek newspapers daily on your website
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: greek-newspapers
*/
// Define the function to generate the HTML for each newspaper
require_once(plugin_dir_path(__FILE__) . 'includes/helpers.php');
function greek_newspapers_add_plugin_actions( $links ) {
    $settings_link = '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=greek_newspapers_settings' ) ) . '">Settings</a>';
    array_unshift( $links, $settings_link);
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'greek_newspapers_add_plugin_actions' );
function greek_newspapers_shortcode()
{
    wp_enqueue_style('greek-newspapers-style', plugins_url('/greek-newspapers.css', __FILE__));
    require_once(plugin_dir_path(__FILE__) . 'includes/fetch.php');
    $groups = $data->widgetGroups;
    $selectedCategories = [];
    // Get options for plugin
    $options = get_option('greek_newspapers_options');
    foreach ($options as $key => $option) {
        if ($option == true) {
            array_push($selectedCategories, $key);
        }
    }
    $html = '<div class="greek-newspapers">';
    foreach ($groups as $group) {
        $group = $group->group;
        $newspapers = $group->newspapers;
        $name = $group->name;
        if (in_array($name, $selectedCategories) && count($newspapers) > 0) {
            $html .= '<h3>' . category_title($name) . '</h3>';
            $html .= '<hr/>';
            $html .= '<div class="greek-newspapers-flexbox">';

            // Loop through the newspapers and generate the HTML for each one
            foreach ($newspapers as $newspaper) {
                $newspaperID = $newspaper->id;
                $newspaperTitle = $newspaper->title;
                $imgUrl = $newspaper->imgUrl;
                $html .= generate_newspaper_html($newspaperID, $newspaperTitle, $imgUrl);
            }
            $html .= '</div>';
        }
    }
    $html .= '</div>';
    return $html;
}
add_shortcode('greek_newspapers', 'greek_newspapers_shortcode');
require_once(plugin_dir_path(__FILE__) . 'includes/settings-form.php');
?>
