<?php

namespace Gehog\StaticPages;

use Gehog\StaticPages\Common\Container;
use Gehog\StaticPages\StaticPage\StaticPageServiceProvider;
use Gehog\StaticPages\Admin\Controllers\EditPageController;
use Gehog\StaticPages\Admin\Controllers\OptionsReadingController;

/**
 * Class Plugin
 *
 * @package Gehog\StaticPages
 */
class Plugin extends Container {
    protected static $instance;

    protected $service_providers = [
      StaticPageServiceProvider::class
    ];

    protected $screen_controllers = [
        'edit-page' => EditPageController::class,
        'options-reading' => OptionsReadingController::class
    ];

    public static function instance($values = []) {
        if (is_null(static::$instance)) {
            return static::$instance = static::load($values);
        }

        foreach ($values as $key => $value) {
            static::$instance->offsetSet($key, $value);
        }

        return static::$instance;
    }

    public static function load($values) {
        $container = new static($values);

        $container->registerProviders();

        \add_action('init', [$container, 'onInit']);
        \add_action('admin_init', [$container, 'onAdminInit']);
        \add_action('current_screen', [$container, 'onAdminCurrentScreen']);

        return $container;
    }

    protected function registerProviders() {
        foreach ($this->service_providers as $provider) {
            $this->register(new $provider());
        }
    }

    public function onInit() {
        \add_filter('query_vars', [$this, 'updateQueryVars']);
        \add_action('pre_get_posts', [$this, 'updateMainQuery']);
        \add_filter('template_include', [$this, 'updateTemplateInclude']);
    }

    public function onAdminInit() {
        \register_setting('reading', 'gehog_static_pages');
    }

    public function onAdminCurrentScreen($screen) {
        foreach ($this->screen_controllers as $screen_id => $controller_class) {
            if ($screen_id === $screen->id) {
                new $controller_class($screen);
            }
        }
    }

    public function updateQueryVars($query_vars) {
        $query_vars[] = 'static_page';
        return $query_vars;
    }

    public function updateMainQuery(\WP_Query $query) {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        $type = get_query_var('static_page', '');

        if (!empty($type)) {
            $page_id = $this->getStaticPageId($type);

            if ($page_id) {
                $query->set('post_type', 'page');
                $query->set('p', $page_id);
            }
        }
    }

    public function updateTemplateInclude($template) {
        if ($this->isStaticPage()) {

        }

        return $template;
    }

    public function isStaticPage() {
        if (!is_page() || is_front_page() || is_home()) {
            return false;
        }

        return false;
    }

    public function getStaticPageTemplate() {
        $static_pages = \get_option('gehog_static_pages', []);
        $page_id = \get_queried_object_id();
        $templates = [];

        if (($type = array_search($page_id, $static_pages)) !== false) {
            $templates[] = "static-page-{$type}.php";
        }

        $templates[] = 'static-page.php';

        return get_query_template('staticpage', $templates);
    }
}
