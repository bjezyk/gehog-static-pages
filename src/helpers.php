<?php

namespace Gehog\StaticPages;

/**
 * Get the available container instance.
 *
 * @param string $name
 * @return mixed
 */
function plugin($name = null) {
    if (is_null($name)) {
        return Plugin::instance();
    }

    return Plugin::instance()->get($name);
}

/**
 * Resolve a service from the container.
 *
 * @param $name
 * @return mixed
 */
function resolve($name) {
    return plugin($name);
}

/**
 * @return \Gehog\StaticPages\StaticPage\StaticPageRepository
 */
function pages() {
    return plugin('pages');
}

/**
 * @return \Gehog\StaticPages\StaticPage\StaticPageTypeManger
 */
function types() {
    return plugin('types');
}

/**
 * @param string $page_type
 * @param array $args
 * @return \Gehog\StaticPages\StaticPage\StaticPageType
 */
function register_page_type($page_type, $args = []) {
    return types()->register($page_type, $args);
}

/**
 * @param string $page_type
 * @return bool|\WP_Error
 */
function unregister_page_type($page_type) {
    return types()->unregister($page_type);
}

/**
 * @return bool
 */
function is_static_page() {
    return plugin()->isStaticPage();
}
