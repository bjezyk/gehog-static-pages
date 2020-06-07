# Static Pages

## Static Pages is a WordPress Plugin which offer comprehensive way to denote custom static pages similar to "Page on front" and "Page for posts".

### Features
- Auto redirect to static page by adding a query search param in the url like `?static_page=page_type`.
- Theming static pages via `static-page-[page_type].php` template files.

### Configuration
To connect your static page type with an existing page, go to *Reading Setting* in administrative area.

### Example usage

#### Registration and unregistration of page type.
```php
add_action('init', function() {
    gehog_register_static_page_type('page_type', [
        'label' => 'Page Type Label',
        'description' => 'Page Type Description'
    ]);
    
    gehog_unregister_static_page_type('page_type');
});
```

### Functions

```php
gehog_register_static_page_type($page_type, [$args]);
```
_Registers a static page type._
- `$page_type` (string) (Required) Unique page type key.
- `$args` (array) (Optional) Additional options for registering a page type.
    - `$label` (string) (Optional) Name of the page type shown in the page listing. Default is value of `$page_type`.
    - `$description` (string) A short descriptive summary of what the page type is.

```php
gehog_unregister_static_page_type($page_type);
```
_Unregisters a static page type._
- `$page_type` (string) (Required) Registered page type key.

```php
gehog_is_static_page([$page], [$page_type]);
```
_Determines whether the query is for an static page._
- `$page` (int|int[]) (Optional) Page ID or array of such ids.
- `$page_type` (string|string[]) (Optional) Static page type or array of such types.
