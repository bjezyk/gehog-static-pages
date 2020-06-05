<?php

namespace Gehog\StaticPages\Common\Admin;

abstract class AdminScreenController {
    private $screen;

    public function __construct(\WP_Screen $screen) {
        $this->screen = $screen;

        $this->initialize();
    }

    /**
     * Intialize controller on screen.
     *
     * @return void
     */
    abstract public function initialize();
}
