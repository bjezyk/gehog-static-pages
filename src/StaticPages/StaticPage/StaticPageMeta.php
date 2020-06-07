<?php

namespace Gehog\StaticPages\StaticPage;

final class StaticPageMeta {
    /**
     * @var int
     */
    public $page_id;

    /**
     * @var string
     */
    public $page_type;

    /**
     * StaticPageMeta constructor.
     *
     * @param string $page_type
     * @param int $page_id
     */
    public function __construct($page_type, $page_id) {
        $this->page_id = $page_id;
        $this->page_type = $page_type;
    }
}
