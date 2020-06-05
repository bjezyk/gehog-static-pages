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
     * @param int|int[]|string|string[] $page
     * @param string|string[] $type
     * @return bool|mixed|void
     */
    function gehog_is_static_page($page = '', $type = '') {
        if (!is_page() || is_front_page() || is_home()) {
            return false;
        }
        unregister_post_type();

        /** @var array $static_pages */
        $static_pages = \get_option('gehog_static_pages', []);
        $is_static_page = false;

        if (!empty($static_pages)) {
            $page_id = \absint($page_id);

            if (!$page_id) {
                $page_id = \get_the_ID();
            }

            if ($page_id) {
                $is_static_page = \in_array($page_id, $static_pages);
            }

            if (!empty($page_type)) {
                $static_page_types = \array_keys($static_pages);
            }
        }

        return \apply_filters('gehog/is_static_page', $is_static_page, $page_type, $page_id);
    }
}
