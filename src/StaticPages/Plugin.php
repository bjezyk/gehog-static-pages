<?php

namespace Gehog\StaticPages;

use Gehog\StaticPages\Common\Container;

/**
 * Class Plugin
 *
 * @package Gehog\StaticPages
 */
class Plugin extends Container {
    protected static $instance;

    protected $service_providers = [
        \Gehog\StaticPages\Settings\SettingsServiceProvider::class,
        \Gehog\StaticPages\StaticPage\StaticPageServiceProvider::class
    ];

    protected $screen_controllers = [
        'edit-page' => \Gehog\StaticPages\Admin\Controller\EditPageController::class,
        'options-reading' => \Gehog\StaticPages\Admin\Controller\OptionsReadingController::class
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

    protected static function load($values) {
        $container = new static($values);

        $container->registerProviders();
        $container->registerHooks();

        return $container;
    }

    /**
     * Register available service providers
     *
     * @return void
     */
    protected function registerProviders() {
        foreach ($this->service_providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * Register plugin hooks
     *
     * @return void
     */
    protected function registerHooks() {
        \add_action('plugins_loaded', [$this, 'onPluginsLoaded']);
        \add_action('admin_init', [$this, 'onAdminInit']);
        \add_action('current_screen', [$this, 'onAdminScreen']);
        \add_action('init', [$this, 'onInit']);
    }

    /**
     * @return void
     */
    public function onPluginsLoaded() {
        $this->loadTextDomain();
        $this->loadPluggableFunctions();
    }

    /**
     * @return void
     */
    public function onAdminInit() {
        /** @var \Gehog\StaticPages\Settings\SettingsManager $settings */
        $settings = $this['settings'];
        $settings->registerSettings();
    }

    /**
     * @param \WP_Screen $screen
     * @return void
     */
    public function onAdminScreen($screen) {
        foreach ($this->screen_controllers as $screen_id => $screen_handlers) {
            if ($screen_id !== $screen->id) {
                continue;
            }

            if (!is_array($screen_handlers)) {
                $screen_handlers = [$screen_handlers];
            }

            foreach ($screen_handlers as $screen_handler) {
                /** @var \Gehog\StaticPages\Common\Admin\ScreenController $controller */
                $controller = new $screen_handler($screen);
                $controller->initialize();
            }
        }
    }

    /**
     * @return void
     */
    public function onInit() {
        \add_filter('query_vars', [$this, 'updateQueryVars']);

        if (!is_admin()) {
            \add_filter('template_include', [$this, 'updateTemplateInclude']);
            \add_action('template_redirect', [$this, 'redirectStaticPage']);
        }
    }

    public function redirectStaticPage() {
        $page_type = sanitize_key(get_query_var('static_page'));

        if (is_404() || empty($page_type)) {
            return;
        }

        if ($static_page = pages()->findByType($page_type)) {
            $permalink = get_permalink($static_page->page_id);

            if ($permalink) {
                parse_str(parse_url(remove_query_arg(['static_page']), PHP_URL_QUERY), $query_args);

                if (!empty($query_args)) {
                    $permalink = add_query_arg($query_args, $permalink);
                }

                wp_safe_redirect($permalink, 301);
                exit();
            }
        }
    }

    public function updateQueryVars($query_vars) {
        $query_vars[] = 'static_page';
        return $query_vars;
    }

    public function updateTemplateInclude($template) {
        if ($this->isStaticPage() && $static_template = $this->getStaticPageTemplate()) {
            $template = $static_template;
        }

        return $template;
    }

    public function isStaticPage() {
        if (!is_page() || is_front_page() || is_home()) {
            return false;
        }

        $page_id = \get_queried_object_id();
        $static_page = pages()->findById($page_id);

        return !is_null($static_page);
    }

    public function getStaticPageTemplate() {
        $templates = [];

        $page = \get_queried_object();

        if ($page instanceof \WP_Post) {
            $static_page = pages()->findById($page->ID);

            if ($static_page) {
                $templates[] = "static-page-{$static_page->page_type}.php";
            }
        }

        $templates[] = 'static-page.php';

        return get_query_template('staticpage', $templates);
    }

    /**
     * Load pluggable plugin functions
     *
     * @return void
     */
    protected function loadPluggableFunctions() {
        require_once GEHOG_STATIC_PAGES_PATH . '/inc/globals.php';
    }

    /**
     * Load plugin text domain for translated strings.
     *
     * @return void
     */
    protected function loadTextDomain() {
        \load_plugin_textdomain(
            'gehog-static-pages',
            false,
            dirname(GEHOG_STATIC_PAGES_BASENAME) . '/resources/languages/'
        );
    }
}
