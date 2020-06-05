<?php

namespace Gehog\StaticPages;

/**
 * @param string|null $id
 * @return \Gehog\StaticPages\Plugin|mixed
 */
function plugin($id = null) {
    if (is_null($id)) {
        return Plugin::instance();
    }

    return Plugin::instance()->get($id);
}

/**
 * @return \Gehog\StaticPages\StaticPage\StaticPageRepository|mixed
 */
function repository() {
    return plugin('repository');
}

/**
 * @param $page_type
 * @param $args
 * @return \Gehog\StaticPages\StaticPage\StaticPageType
 */
function register_page_type($page_type, $args) {
    return repository()->registerPageType($page_type, $args);
}

/**
 * @param $page_type
 * @return bool|\WP_Error
 */
function unregister_page_type($page_type) {
    return repository()->unregisterPageType($page_type);
}
