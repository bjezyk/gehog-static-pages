<?php

if (!function_exists('gehog_register_static_page_type')) {
    function gehog_register_static_page_type(...$args) {
        return \Gehog\StaticPages\register_page_type(...$args);
    }
}

if (!function_exists('gehog_unregister_static_page_type')) {
    function gehog_unregister_static_page_type(...$args) {
        return \Gehog\StaticPages\unregister_page_type(...$args);
    }
}

if (!function_exists('gehog_is_static_page')) {
    function gehog_is_static_page() {

    }
}
