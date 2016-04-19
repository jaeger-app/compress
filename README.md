# Jaeger Compress Object

[![Build Status](https://travis-ci.org/jaeger-app/compress.svg?branch=master)](https://travis-ci.org/jaeger-app/compress)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jaeger-app/compress/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jaeger-app/compress/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/jaeger-app/compress/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/jaeger-app/compress/?branch=master)
[![Author](http://img.shields.io/badge/author-@mithra62-blue.svg?style=flat-square)](https://twitter.com/mithra62)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/jaeger-app/bootstrap/master/LICENSE)

A compression wrapper to manipulate Zip files with PHP using a simple interface. You can create and modify zip archives as well as extract them.

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

## Compress Single File (Remove Original)

If you want to remove the file being compressed, just set the `setKeepOriginal()` method to `true`:

```php
use \JaegerApp\Compress;

$backup_file = '/path/to/file.ext';
$store_path = '/path/to/store.zip';
$compress = new Compress();
$compress->setKeepOriginal(true)->setArchiveName($store_path)->archiveSingle($backup_file);

```

## Compress Multiple Files

To backup multiple files, be them single files or directories, it'll work like the below:

```php
use \JaegerApp\Compress;

$store_path = '/path/to/store.zip';
$compress = new Compress();
$compress->create($store_path);
$compress->add('/path/to/file/test.php');
$compress->add('/path/to/dir2');
$compress->add('/path/to/dir3');
$path_to_archive = $compress->close();
```

## Extract Archive

To extract an archive:

```php
use \JaegerApp\Compress;

$archive_path = '/path/to/archive.zip';
$destination = '/path/to/store/data';
$compress = new Compress();
$compress->extract($archive_path, $destination);
```