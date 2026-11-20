# Changelog

## v1.0.7 - 2026-11-20

### Changed

- Works with super-admin 2.x: the package now requires `super-admin-org/super-admin` `^1.0|^2.0`. Earlier versions required `^1.0`, so Composer could not install them next to super-admin v2.0.0.
- Package homepage and documentation: https://super-admin.org/laravel/extension-ckeditor/

## v1.0.6 - 2026-11-20

### Added

- Assets are also tagged `laravel-assets`, so Laravel apps republish them after every `composer update` (`php artisan admin:upgrade` does the same in super-admin versions that have it).
