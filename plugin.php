<?php
/**
 * Gehog Static Pages Plugin
 *
 * @wordpress-plugin
 * Plugin Name: Gehog Static Pages
 * Plugin URI: https://wp.gehog.com/plugins/static-pages/
 * Description: Manage custom static pages defined by third-party themes.
 * Author: Gehog
 * Author URI: https://wp.gehog.com/
 * Version: 0.0.1
 * Text Domain: gehog-static-pages
 * Domain Path: /resources/languages
 * Requires PHP: 7.1
 * Requires at least: 5.1
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    http_send_status(404);
    die();
}

/*
 * Prevent loading plugin during the WordPress installation.
 */
if (wp_installing()) {
    return;
}

define('GEHOG_STATIC_PAGES_VERSION', '0.0.1');
define('GEHOG_STATIC_PAGES_FILE', __FILE__ );
define('GEHOG_STATIC_PAGES_BASENAME', plugin_basename(__FILE__));
define('GEHOG_STATIC_PAGES_PATH', plugin_dir_path(__FILE__));
define('GEHOG_STATIC_PAGES_URL', plugin_dir_url(__FILE__));

/*
 * Bootstrap the Plugin
 */

if (!is_readable($autoload = __DIR__ . '/vendor/autoload.php')) {
    wp_die('Gehog Static Pages Plugin Autoload Error.');
}

require $autoload;

Gehog\StaticPages\Plugin::instance();

add_action('init', function () {
    gehog_register_static_page_type('media', ['label' => 'Media']);
    gehog_register_static_page_type('document', ['label' => 'Document']);
});
