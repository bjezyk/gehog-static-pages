# Static Pages

### Static Pages is a WordPress Plugin which offer comprehensive way to register page only custom templates.

#### Features
Querying static pages within WP_Query by passing new query var `staticpage`.

Auto redirect to static page by adding a query search param in the url like `?staticpage=page_type`.

### Example usage
```php
add_action('init', function() {
    gehog_register_static_page_type('page_type', [
        'label' => 'Page Type Label',
        'description' => 'Page Type Description'
    ]);
    
    gehog_unregister_static_page_type('page_type');
});
```

```php
$query = new WP_Query([
    'staticpage' => 'page_type'
]);
```

### Functions

`gehog_unregister_static_page_type($page_type, [$args]);`

- `$page_type` (string) (Required) Unique page type name.
- `$args (array)` (Optional) Additional page type options.

`gehog_register_static_page_type();`

`gehog_is_static_page();`
