<?php

namespace Gehog\StaticPages\Common;

use Psr\Container\ContainerInterface;

class Container extends \Pimple\Container implements ContainerInterface {
    /**
     *  {@inheritdoc}
     */
    public function get($id) {
        return $this->offsetGet($id);
    }

    /**
     *  {@inheritdoc}
     */
    public function has($id) {
        return $this->offsetExists($id);
    }
}
