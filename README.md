# Wordpress Static Pages Plugin

Registration new static page type via `gehog_register_static_page_type`.

```php
add_action('init', function() {
    gehog_register_static_page_type('page_type', [
        'label' => 'Page Type Label',
        'description' => 'Page Type Description'
    ]);
});
```
