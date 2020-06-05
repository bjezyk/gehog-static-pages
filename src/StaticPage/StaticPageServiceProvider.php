<?php

namespace Gehog\StaticPages\StaticPage;

use Pimple\ServiceProviderInterface;

class StaticPageServiceProvider implements ServiceProviderInterface {
    /**
     * @param \Pimple\Container $container
     */
    public function register($container) {
        $container['repository'] = function() {
          return new StaticPageRepository();
        };
    }
}
