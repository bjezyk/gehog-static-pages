<?php

namespace Gehog\StaticPages\StaticPage;

/**
 * Class StaticPageRepository
 *
 * @package Gehog\StaticPages\StaticPage
 */
class StaticPageRepository {
    /**
     * @var \Gehog\StaticPages\StaticPage\StaticPageMeta[]
     */
    protected $pages = [];

    /**
     * @return \Gehog\StaticPages\StaticPage\StaticPageMeta[]
     */
    public function findAll() {
        /** @var array $data */
        $data = \get_option('gehog_static_pages');
        $pages = [];

        if (\is_array($data)) {
            foreach ($data as $page_type => $page_id) {
                $page_type = \sanitize_key($page_type);
                $pages[] = new StaticPageMeta($page_type, $page_id);
            }
        }

        return $pages;
    }

    /**
     * @param string|int $id
     * @return \Gehog\StaticPages\StaticPage\StaticPageMeta|null
     */
    public function findById($id) {
        if (is_string($id)) {
            $id = intval($id);
        }

        foreach ($this->findAll() as $page) {
            if ($page->page_id == $id) {
                return $page;
            }
        }

        return null;
    }

    /**
     * @param \Gehog\StaticPages\StaticPage\StaticPageType|string $type
     * @return \Gehog\StaticPages\StaticPage\StaticPageMeta|mixed
     */
    public function findByType($type) {
        if ($type instanceof StaticPageType) {
            $type = $type->name;
        }

        foreach ($this->findAll() as $page) {
            if ($page->page_type == $type) {
                return $page;
            }
        }

        return null;
    }
}
