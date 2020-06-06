<?php

namespace Gehog\StaticPages\Common\Admin;

/**
 * Class ScreenController
 *
 * @package Gehog\StaticPages\Common\Admin
 */
abstract class ScreenController {
    /** @var \WP_Screen */
    private $screen;

    /**
     * AdminScreenController constructor.
     *
     * @param \WP_Screen $screen
     */
    public function __construct($screen) {
        $this->screen = $screen;
    }

    /**
     * Initialize controller on current screen.
     *
     * @return void
     */
    abstract public function initialize();
}
