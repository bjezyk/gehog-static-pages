<?php

if (!function_exists('gehog_register_static_page_type')) {
    function gehog_register_static_page_type(...$args) {
        return \Gehog\StaticPages\register_static_page_type(...$args);
    }
}

if (!function_exists('gehog_get_static_page')) {
    function gehog_get_static_page(...$args) {
        return \Gehog\StaticPages\get_static_page(...$args);
    }
}

if (!function_exists('gehog_get_static_page_id')) {
    function gehog_get_static_page_id(...$args) {
        return \Gehog\StaticPages\get_static_page_id(...$args);
    }
}

if (!function_exists('gehog_is_static_page')) {
    function gehog_is_static_page(...$args) {
        return \Gehog\StaticPages\is_static_page(...$args);
    }
}
