<?php

namespace Gehog\StaticPages\Admin\Controllers;

use Gehog\StaticPages\Common\Admin\AdminScreenController;

use function Gehog\StaticPages\repository;

class EditPageController extends AdminScreenController {
    public function initialize() {
        if (repository()->hasRegisteredPageTypes()) {
            \add_filter('display_post_states', [$this, 'updatePageStates'], 10, 2);
        }
    }

    /**
     * Update existing states including static page types labels.
     *
     * @param string[] $states An array of post display states.
     * @param \WP_Post $page The current post object.
     * @return string[]
     */
    public function updatePageStates($states, $page) {
        $reserved_states = ['page_for_posts', 'page_on_front', 'page_for_privacy_policy'];
        $has_reserved_state = boolval(count(array_intersect_key(array_flip($reserved_states), $states)));

        if ($has_reserved_state) {
            return $states;
        }

        $static_page = repository()->findRegisteredStaticPageById($page->ID);

        if (!empty($static_page)) {
            $page_type = repository()->getRegisteredPageType($static_page->page_type);
            $states["static_page_{$static_page->page_type}"] = $page_type->label;
        }

        return $states;
    }
}
