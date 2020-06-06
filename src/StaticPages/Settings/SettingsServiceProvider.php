<?php

namespace Gehog\StaticPages\Settings;

use Pimple\ServiceProviderInterface;

/**
 * Class SettingsServiceProvider
 *
 * @package Gehog\StaticPages\Settings
 */
class SettingsServiceProvider implements ServiceProviderInterface {
    /**
     * @inheritDoc
     */
    public function register($container) {
        $container['settings'] = function() {
            return new SettingsManager();
        };
    }
}
