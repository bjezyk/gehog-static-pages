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
    protected $types = [];

    /**
     * Register new page type
     *
     * @param string $name
     * @param array|null $args
     * @return \Gehog\StaticPages\StaticPage\StaticPageType
     */
    public function register($name, $args = null) {
        $name = \sanitize_key($name);
        $type = new StaticPageType($name, $args);

        $this->set($type);

        return $type;
    }

    /**
     * Unregister defined page type.
     *
     * @param string $name
     * @return bool|\WP_Error
     */
    public function unregister($name) {
        if (!$this->isRegistered($name)) {
            return new \WP_Error(
                'invalid_static_page_type_name',
                __('Invalid static page type name.', 'gehog-static-pages')
            );
        }

        unset($this->types[$name]);

        return true;
    }

    /**
     * Check if a page type is registered.
     *
     * @param string $name
     * @return bool
     */
    public function isRegistered($name) {
        return isset($this->types[$name]);
    }

    /**
     * Check if at least one page type is registered.
     *
     * @return bool
     */
    public function hasRegistration() {
        return \boolval(\count($this->types));
    }

    /**
     * @return \Gehog\StaticPages\StaticPage\StaticPageType[]
     */
    public function getAll() {
        return \array_values($this->types);
    }

    /**
     * @param string $type
     * @return \Gehog\StaticPages\StaticPage\StaticPageType|null
     */
    public function get($type) {
        return $this->types[$type];
    }

    /**
     * @param \Gehog\StaticPages\StaticPage\StaticPageType $type
     * @return void
     */
    public function set($type) {
        $this->types[$type->name] = $type;
    }
}
