<?php

namespace Gehog\StaticPages\Common\Admin;

/**
 * Class AdminScreenController
 *
 * @package Gehog\StaticPages\Common\Admin
 */
abstract class AdminScreenController {
    /** @var \WP_Screen */
    private $screen;

    /**
     * AdminScreenController constructor.
     *
     * @param \WP_Screen $screen
     */
    public function __construct($screen) {
        $this->screen = $screen;

        $this->initialize();
    }

    /**
     * Initialize controller on screen.
     *
     * @return void
     */
    abstract public function initialize();
}
