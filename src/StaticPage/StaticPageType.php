<?php

namespace Gehog\StaticPages\StaticPage;

final class StaticPageType {
    public $name;
    public $label;
    public $description = '';
    public $query_var;

    /**
     * StaticPageType constructor.
     *
     * @param string $page_type
     * @param array|string $args
     */
    public function __construct($page_type, $args = []) {
        $this->name = $page_type;
        $this->setProperties($args);
    }

    /**
     * Sets static page type properties.
     *
     * @param array $args
     * @return void
     */
    private function setProperties($args = []) {
        $args = wp_parse_args($args);
        $args = apply_filters('gehog/static_pages/type/args', $args, $this->name);

        $default_args = [
            'label' => $this->name,
            'description' => '',
            'query_var' => true
        ];

        $args = array_merge($default_args, $args);

        foreach ($args as $property_name => $property_value) {
            $this->$property_name = $property_value;
        }
    }
}
