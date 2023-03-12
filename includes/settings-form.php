<?php
// Add menu item for plugin settings page
function greek_newspapers_settings_menu()
{
    add_options_page(
        'Greek Newspapers Settings',
        'Greek Newspapers',
        'manage_options',
        'greek_newspapers_settings',
        'greek_newspapers_settings_page'
    );
}
add_action('admin_menu', 'greek_newspapers_settings_menu');

// Display settings page for plugin
function greek_newspapers_settings_page()
{
    // Check if user is authorized to access settings page
    if (!current_user_can('manage_options')) {
        return;
    }

    // Get the current options for the plugin
    $options = get_option('greek_newspapers_options');

    // If no options exist, set defaults
    if (empty($options)) {
        $options = array(
            'politikes' => false,
            'oikonomikes' => false,
            'kuriakatikes' => false,
            'athlitikes' => false,
            'evdomadiaies' => false,
            'perifereia' => false,
            'evdomadiaia_periodika' => false,
            'athlitika_periodika' => false,
            'free_press' => false,
            'miniaia_periodika' => false,
        );
    }

    // If form is submitted, save options
    if (isset($_POST['submit'])) {
        $options['politikes'] = isset($_POST['politikes']);
        $options['oikonomikes'] = isset($_POST['oikonomikes']);
        $options['kuriakatikes'] = isset($_POST['kuriakatikes']);
        $options['athlitikes'] = isset($_POST['athlitikes']);
        $options['evdomadiaies'] = isset($_POST['evdomadiaies']);
        $options['perifereia'] = isset($_POST['perifereia']);
        $options['evdomadiaia_periodika'] = isset($_POST['evdomadiaia_periodika']);
        $options['athlitika_periodika'] = isset($_POST['athlitika_periodika']);
        $options['free_press'] = isset($_POST['free_press']);
        $options['miniaia_periodika'] = isset($_POST['miniaia_periodika']);
        update_option('greek_newspapers_options', $options);
    }
?>

    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p><?php echo esc_html__('To display the newspapers on your website, you can use the following shortcode:', 'greek-newspapers'); ?> <code>[greek_newspapers]</code></p>
        <p><?php echo esc_html__('Make sure to include the shortcode in a post or page where you want the newspapers to appear.', 'greek-newspapers'); ?></p>
        <form method="post">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">Πολιτικές</th>
                        <td>
                            <input type="checkbox" name="politikes" <?php checked($options['politikes'], true); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Οικονομικές</th>
                        <td>
                            <input type="checkbox" name="oikonomikes" <?php checked($options['oikonomikes'], true); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Κυριακάτικες</th>
                        <td>
                            <input type="checkbox" name="kuriakatikes" <?php checked($options['kuriakatikes'], true); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Αθλητικές</th>
                        <td>
                            <input type="checkbox" name="athlitikes" <?php checked($options['athlitikes'], true); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Εβδομαδιαίες</th>
                        <td>
                            <input type="checkbox" name="evdomadiaies" <?php checked($options['evdomadiaies'], true); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Περιφέρεια</th>
                        <td>
                            <input type="checkbox" name="perifereia" <?php checked($options['perifereia'], true); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Εβδομαδιαία Περιοδικά</th>
                        <td>
                            <input type="checkbox" name="evdomadiaia_periodika" <?php checked($options['evdomadiaia_periodika'], true); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Αθλητικά Περιοδικά</th>
                        <td>
                            <input type="checkbox" name="athlitika_periodika" <?php checked($options['athlitika_periodika'], true); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Free Press</th>
                        <td>
                            <input type="checkbox" name="free_press" <?php checked($options['free_press'], true); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Μικρά Περιοδικά</th>
                        <td>
                            <input type="checkbox" name="miniaia_periodika" <?php checked($options['miniaia_periodika'], true); ?>>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
?>