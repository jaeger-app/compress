# Jaeger Compress Object

[![Build Status](https://travis-ci.org/jaeger-app/compress.svg?branch=master)](https://travis-ci.org/jaeger-app/compress)
[![Author](http://img.shields.io/badge/author-@mithra62-blue.svg?style=flat-square)](https://twitter.com/mithra62)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/jaeger-app/bootstrap/master/LICENSE)

Manipulate zip files using a simple interface. You can create and modify zip archives as well as extract them.

## Installation
Add `jaeger-app/compress` as a requirement to your `composer.json`:

```bash
$ composer require jaeger-app/compress
```

## Compress Single File


```php
use \JaegerApp\Compress;

$backup_file = '/path/to/file.php';
$store_path = '/path/to/store';
$compress = new Compress();
$compress->setArchiveName($store_path)->archiveSingle($backup_file);

```