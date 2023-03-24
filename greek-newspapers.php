<?php
/*
Plugin Name: Greek Newspapers
Version: 1.0
Author: Giorgos Iliopoulos
Author URI: https://giorgos-iliopoulos.eu
Description: Display Greek newspapers daily on your website
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: greek-newspapers
*/

require_once(plugin_dir_path(__FILE__) . 'includes/helpers.php');
function greek_newspapers_add_plugin_actions($links)
{
    $settings_link = '<a href="' . esc_url(get_admin_url(null, 'options-general.php?page=greek_newspapers_settings')) . '">' . esc_attr__('Settings', 'greek-newspapers') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'greek_newspapers_add_plugin_actions');

require_once(plugin_dir_path(__FILE__) . 'includes/setup.php');
function greek_newspapers_shortcode()
{
    require_once(plugin_dir_path(__FILE__) . 'includes/fetch.php');
    $groups = $data->widgetGroups;
    $selectedCategories = [];
    // Get options for plugin
    $options = get_option('greek_newspapers_options');
    $viewMode = isset($options['view_mode']) ? $options['view_mode'] : '';
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
            $html .= '<h3>' . wp_kses(greek_newspapers_category_title($name), array()) . '</h3>';
            $html .= '<hr/>';
            // Check the selected view mode and generate the HTML accordingly
            if ($viewMode === 'flexbox' || count($newspapers) < 3) {
                $html .= '<div class="greek-newspapers-flexbox">';

                // Loop through the newspapers and generate the HTML for each one
                foreach ($newspapers as $newspaper) {
                    $newspaperID = $newspaper->id;
                    $newspaperTitle = $newspaper->title;
                    $imgUrl = $newspaper->imgUrl;
                    $html .= generate_newspaper_html($newspaperID, $newspaperTitle, $imgUrl);
                }

                $html .= '</div>';
            } else if ($viewMode === 'slider') {
                $html .= '<div id="' . esc_attr($name) . '" class="greek-newspapers-slider splide">';
                $html .= '<div class="splide__track">';
                $html .= '<ul class="splide__list">';

                // Loop through the newspapers and generate the HTML for each one
                foreach ($newspapers as $newspaper) {
                    $newspaperID = $newspaper->id;
                    $newspaperTitle = $newspaper->title;
                    $imgUrl = $newspaper->imgUrl;
                    $html .= generate_newspaper_slides($newspaperID, $newspaperTitle, $imgUrl);
                }

                $html .= '</ul>';
                $html .= '</div>';
                $html .= '</div>';
            }
        }
    }
    $html .= '</div>';
    return $html;
}
add_shortcode('greek_newspapers', 'greek_newspapers_shortcode');
require_once(plugin_dir_path(__FILE__) . 'includes/settings-form.php');
