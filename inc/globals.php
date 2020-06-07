<?php

if (!function_exists('gehog_register_static_page_type')) {
    /**
     * @param string $page_type
     * @param array $args
     * @return \Gehog\StaticPages\StaticPage\StaticPageType
     */
    function gehog_register_static_page_type($page_type, $args = []) {
        return \Gehog\StaticPages\register_page_type($page_type, $args);
    }
}

if (!function_exists('gehog_unregister_static_page_type')) {
    /**
     * @param string $page_type
     * @return bool|\WP_Error
     */
    function gehog_unregister_static_page_type($page_type) {
        return \Gehog\StaticPages\unregister_page_type($page_type);
    }
}

if (!function_exists('gehog_is_static_page')) {
    /**
     * @return bool
     */
    function gehog_is_static_page() {
        return \Gehog\StaticPages\is_static_page();
    }
}
