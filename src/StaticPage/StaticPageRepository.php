<?php

namespace Gehog\StaticPages\StaticPage;

/**
 * Class StaticPageRepository
 *
 * @package Gehog\StaticPages\StaticPage
 */
class StaticPageRepository {
    /**
     * @var \Gehog\StaticPages\StaticPage\StaticPageType[]
     */
    protected $page_types;

    /**
     * @var \Gehog\StaticPages\StaticPage\StaticPageMeta[]
     */
    protected $static_pages;

    /**
     * StaticPageRepository constructor.
     */
    public function __construct() {
        $this->page_types = [];
        $this->static_pages = [];

        /** @var array $data */
        $static_pages_meta = \get_option('gehog_static_pages', []);

        if (\is_array($static_pages_meta)) {
            foreach ($static_pages_meta as $page_type => $page_id) {
                if ($this->hasRegisteredPageType($page_type)) {
                    $this->static_pages[$page_type] = new StaticPageMeta($page_type, $page_id);
                }
            }
        }
    }

    /**
     * @return \Gehog\StaticPages\StaticPage\StaticPageType[]
     */
    public function getRegisteredPageTypes() {
        return \array_values($this->page_types);
    }

    /**
     * @param string $page_type
     * @return \Gehog\StaticPages\StaticPage\StaticPageType|null
     */
    public function getRegisteredPageType($page_type) {
        return $this->page_types[$page_type];
    }

    /**
     * @return bool
     */
    public function hasRegisteredPageTypes() {
        return \boolval(\count($this->page_types));
    }

    /**
     * @return \Gehog\StaticPages\StaticPage\StaticPageMeta[]
     */
    public function getRegisteredStaticPages() {
        return \array_values($this->static_pages);
    }

    /**
     * @param $page_id
     * @return \Gehog\StaticPages\StaticPage\StaticPageMeta|null
     */
    public function findRegisteredStaticPageById($page_id) {
        foreach ($this->static_pages as $static_page) {
            if ($static_page->page_id == $page_id) {
                return $static_page;
            }
        }

        return null;
    }

    /**
     * @param string $page_type
     * @param array|null $args
     * @return \Gehog\StaticPages\StaticPage\StaticPageType
     */
    public function registerPageType($page_type, $args = null) {
        $page_type = \sanitize_key($page_type);

        return $this->page_types[$page_type] = new StaticPageType($page_type, $args);
    }

    public function unregisterPageType($page_type) {
        if (!$this->hasRegisteredPageType($page_type)) {
            return new \WP_Error('invalid_static_page_type', __('Invalid static page type.', 'gehog-static-pages'));
        }

        unset($this->page_types[$page_type]);
    }

    public function hasRegisteredPageType($page_type) {
        return isset($this->page_types[$page_type]);
    }

    /**
     * @param $page_type
     * @return int|null
     */
    public function getStaticPageId($page_type) {
        if (isset($static_pages[$page_type])) {
            return $static_pages[$page_type];
        }

        return false;
    }

    /**
     * @param string $page_type
     * @param string $output
     * @param string $filter
     * @return \WP_Post|array|null
     */
    public function getStaticPage($page_type, $output = OBJECT, $filter = 'raw') {
        if ($page_id = $this->getStaticPageId($page_type)) {
            return \get_post($page_id, $output, $filter);
        }

        return null;
    }

    public function isStaticPage($page_id = 0, $page_type = '') {
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
