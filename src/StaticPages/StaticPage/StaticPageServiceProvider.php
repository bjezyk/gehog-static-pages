<?php

namespace Gehog\StaticPages\StaticPage;

use Pimple\ServiceProviderInterface;

/**
 * Class StaticPageServiceProvider
 *
 * @package Gehog\StaticPages\StaticPage
 */
class StaticPageServiceProvider implements ServiceProviderInterface {
    /**
     * @inheritDoc
     */
    public function register($container) {
        $container['pages'] = function() {
          return new StaticPageRepository();
        };

        $container['types'] = function() {
            return new StaticPageTypeManger();
        };
    }
}
