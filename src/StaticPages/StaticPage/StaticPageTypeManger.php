<?php

namespace Gehog\StaticPages\StaticPage;

/**
 * Class StaticPageTypeManger
 *
 * @package Gehog\StaticPages\StaticPage
 */
class StaticPageTypeManger {
    /**
     * @var \Gehog\StaticPages\StaticPage\StaticPageType[]
     */
    protected $types;

    /**
     * Register new page type
     *
     * @param string $name
     * @param array|null $args
     * @return \Gehog\StaticPages\StaticPage\StaticPageType
     */
    public function register($name, $args = null) {
        $name = \sanitize_key($name);
        return $this->types[$name] = new StaticPageType($name, $args);
    }

    /**
     * Unregister certain page type.
     *
     * @param string $name
     * @return bool|\WP_Error
     */
    public function unregister($name) {
        if (!$this->isRegistered($name)) {
            return new \WP_Error('invalid_static_page_type_name', __('Invalid static page type name.', 'gehog-static-pages'));
        }

        unset($this->types[$name]);
        return true;
    }

    /**
     * Check if the page type is registered.
     *
     * @param string $name
     * @return bool
     */
    public function isRegistered($name) {
        return isset($this->types[$name]);
    }
}
