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

if (!\defined('ABSPATH')) {
    http_send_status(404);
    die();
}

/*
 |-----------------------------------------------------------
 | Bootstraping Plugin
 |-----------------------------------------------------------
 */

if (!is_readable($autoload = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Gehog Theme Autoload Error.', 'gehog-static-pages'));
}

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require $autoload;

\Gehog\StaticPages\Plugin::instance([
  'loader' => $loader
]);
