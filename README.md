<p align="center">
<a href="https://github.com/super-admin-org/ckeditor"><img src="https://img.shields.io/badge/super--admin-extension-blue" alt="Super Admin Extension"></a>
<a href="https://packagist.org/packages/super-admin-org/ckeditor"><img src="https://img.shields.io/packagist/v/super-admin-org/ckeditor" alt="Latest Version"></a>
<a href="https://packagist.org/packages/super-admin-org/ckeditor"><img src="https://img.shields.io/packagist/dt/super-admin-org/ckeditor" alt="Total Downloads"></a>
<a href="https://github.com/super-admin-org/ckeditor/blob/main/LICENSE"><img src="https://img.shields.io/github/license/super-admin-org/ckeditor" alt="License"></a>
</p>

# CKEditor Extension for Super Admin

A powerful [Super Admin](https://github.com/super-admin-org/super-admin) extension that seamlessly integrates the **CKEditor 4 WYSIWYG editor** into your admin panel forms. Replace plain textareas with a full-featured rich text editor — complete with formatting tools, image uploads, link management, and media browser integration.

## Screenshot

![field-ckeditor](https://user-images.githubusercontent.com/86517067/149800371-a99f23ba-c979-4122-bb7d-2cc32ecd0982.png)

## Features

- **Rich Text Editing** — Full WYSIWYG editor with bold, italic, lists, headings, tables, and more
- **Media Browser Integration** — Browse and insert images directly from Super Admin's built-in media manager
- **Link Management** — Insert and edit links with a user-friendly dialog
- **Global & Per-Field Configuration** — Set defaults globally or customize each editor instance
- **Multi-Language Support** — Configure the editor UI in any supported language
- **Custom Styling** — Apply your own CSS to match the editor content with your frontend design
- **Auto-Discovery** — Works out of the box with Laravel's package auto-discovery
- **Secure** — Ships with CKEditor 4.25+, patched against known XSS vulnerabilities

## Requirements

- PHP >= 7.0
- Laravel >= 7.0
- [Super Admin](https://github.com/super-admin-org/super-admin) >= 1.0

## Installation

**Step 1:** Install the package via Composer:

```bash
composer require super-admin-org/ckeditor
```

**Step 2:** Publish the CKEditor assets:

```bash
php artisan vendor:publish --tag=super-admin-ckeditor
```

That's it! The service provider is auto-discovered by Laravel.

## Configuration

Add your editor settings in the `extensions` section of `config/admin.php`:

```php
'extensions' => [

    'ckeditor' => [

        // Set to false to disable this extension
        'enable' => true,

        // Global editor configuration
        'config' => [
            'language'    => 'en',
            'height'      => 500,
        ]
    ]
]
```

### Available Configuration Options

| Option | Type | Description |
|--------|------|-------------|
| `enable` | `bool` | Enable or disable the extension |
| `config.language` | `string` | Editor UI language (`'en'`, `'de'`, `'fr'`, `'es'`, etc.) |
| `config.height` | `int` | Editor height in pixels |
| `config.contentsCss` | `string` | Path to custom CSS applied inside the editor |

For all available CKEditor options, see the [CKEditor 4 Documentation](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html).

## Usage

### Basic Usage

Add a CKEditor field to any Super Admin form:

```php
$form->ckeditor('content');
```

### With Custom Options

Override global config on a per-field basis using the `options()` method:

```php
$form->ckeditor('content')->options([
    'lang'   => 'fr',
    'height' => 500,
]);
```

### With Custom Content Styling

Match the editor's content area with your frontend styles:

```php
$form->ckeditor('content')->options([
    'contentsCss' => '/css/frontend-body-content.css',
]);
```

### Full Form Example

Here's a complete example of a blog post form with a CKEditor field:

```php
protected function form()
{
    $form = new Form(new Post());

    $form->text('title', 'Title')->required();
    $form->text('slug', 'Slug')->required();
    $form->image('thumbnail', 'Thumbnail');

    $form->ckeditor('body', 'Content')->options([
        'height' => 600,
    ]);

    $form->select('status', 'Status')->options([
        'draft'     => 'Draft',
        'published' => 'Published',
    ]);

    $form->datetime('published_at', 'Publish Date');

    return $form;
}
```

### Image & Media Browser

The extension integrates with Super Admin's media manager out of the box. When inserting an image or link in the editor, users can browse and select files from the media library — no extra configuration needed.

## Troubleshooting

### CKEditor not showing up

If the editor doesn't appear after installation, clear Laravel's compiled services and cached packages:

```bash
php artisan optimize:clear
```

Then re-publish the assets:

```bash
php artisan vendor:publish --tag=super-admin-ckeditor --force
```

### Assets not loading

Make sure your web server can serve files from the `public/vendor/` directory. After publishing, the CKEditor files should be located at:

```
public/vendor/super-admin-org/ckeditor/
```

## Updating

To update the package and its CKEditor assets:

```bash
composer update super-admin-org/ckeditor
php artisan vendor:publish --tag=super-admin-ckeditor --force
```

## License

Licensed under [The MIT License (MIT)](LICENSE).
