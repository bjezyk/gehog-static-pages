<?php

namespace Gehog\StaticPages\StaticPage;

use Pimple\ServiceProviderInterface;

class StaticPageServiceProvider implements ServiceProviderInterface {
    /**
     * @param \Pimple\Container $container
     */
    public function register($container) {
        $container['pages'] = function($c) {
          return new StaticPageRepository($c['types']);
        };

        $container['types'] = function() {
            return new StaticPageTypeManger();
        };
    }
}
