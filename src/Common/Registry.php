<?php

namespace Gehog\StaticPages\Common;

class Registry {
    protected $values = [];

    public function get($key) {
        return $this->values[$key];
    }

    public function set($key, $value) {
        $this->values[$key] = $value;
    }
}
