# CodeIgniter 3 Log Viewer

A Laravel-free adaptation of `opcodesio/log-viewer` package compatible with CodeIgniter 3 (PHP 7.4+).

## Installation

1. Install via Composer:
   ```bash
   composer require iqtool/ci3-log-viewer
   ```

2. Copy the config template from `vendor/iqtool/ci3-log-viewer/config/log_viewer.php` to your `application/config/log_viewer.php`.

3. Copy the view folder to `application/views/log_viewer/`.

4. Copy the controller file to `application/controllers/LogViewer.php`.

5. Copy the static assets (`app.js`, `app.css`) from the package's `assets/` to your public directory path `assets/iqtool/ci3-log-viewer/`.

## Configuration

Ensure that Composer Autoloading is enabled in your `application/config/config.php`:
```php
$config['composer_autoload'] = TRUE;
```

Load the library in your code or via `application/config/autoload.php`:
```php
$autoload['libraries'] = array('Ci3LogViewer');
```

Add routes to `application/config/routes.php`:
```php
$route['log-viewer'] = 'LogViewer/index';
$route['log-viewer/api/files'] = 'LogViewer/get_files';
$route['log-viewer/api/files/(:any)/download'] = 'LogViewer/download_file/$1';
$route['log-viewer/api/files/(:any)'] = 'LogViewer/delete_file/$1';
```
