<?php

namespace Gehog\StaticPages\Settings;

class SettingsManager {
    public function registerSettings() {
        \register_setting('reading', 'gehog_static_pages', [
          'type' => 'array',
          'show_in_rest' => false,
          'default' => []
        ]);

        add_filter('sanitize_option_gehog_static_pages', [$this, 'validateSettings'], 10, 3);
    }

    /**
     * @param mixed $current_value
     * @param string $option
     * @param mixed $previous_value
     * @return mixed
     */
    public function validateSettings($settings, $option, $old_settings) {
        if (!is_array($settings)) {
            return '';
        }

        foreach ($settings as $key => $value) {
            $settings[$key] = absint($value);
        }

        $static_pages = array_values($settings);

        if (count($static_pages) !== count(array_unique($static_pages, SORT_NUMERIC))) {
            add_settings_error(
                $option,
                'selected_same_pages',
                print_r($old_settings, true) . __('Unable to set the same page for a multiple static page types.', 'gehog-static-pages'),
            );

            return $old_settings;
        }

        return $settings;
    }
}
