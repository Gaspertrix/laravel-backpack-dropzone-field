# Backpack Dropzone field

Add Dropzone support for [Laravel Backpack](https://laravel-backpack.readme.io/docs).

## Requirements
- [Laravel Backpack v4](https://laravel-backpack.readme.io/docs)
	- [Installation](https://backpackforlaravel.com/docs/4.0/installation "Installation")
	- [Getting Started](https://backpackforlaravel.com/docs/4.0/introduction "Getting Started")
- [Spatie Laravel Medialibrary v7](https://docs.spatie.be/laravel-medialibrary/v7/)
	- [Installation & setup](https://docs.spatie.be/laravel-medialibrary/v7/installation-setup "Installation & setup")
	- [Basic usage - Preparing your model](https://docs.spatie.be/laravel-medialibrary/v7/basic-usage/preparing-your-model "Basic usage - Preparing your model")

## Limitations
Currently, you can only manage media while editing an entry.

## Install

### Via Composer

``` bash
composer require gaspertrix/laravel-backpack-dropzone-field:^3.0.0
```

The package will automatically register itself.

You must publish public assets:
``` bash
php artisan gaspertrix:backpack:dropzone:install
```

You may publish views with:
``` bash
php artisan vendor:publish --provider="Gaspertrix\LaravelBackpackDropzoneField\DropzoneFieldServiceProvider" --tag="views"
```

## Usage

### EntityCrudController

For simplicity add the `MediaOperation` operation to EntityCrudController.

```php
<?php

...


class EntityCrudController extends CrudController
{
	...
    use \Gaspertrix\LaravelBackpackDropzoneField\App\Http\Controllers\Operations\MediaOperation;

	...
}

```

### Field


```
[
	...
	'type' => 'dropzone_media',
	'view_namespace' => 'dropzone::fields',
	'collection' => 'photos', // Media collection where files are added to
	'thumb_collection' => 'thumbs', // Media collection where thumb are displayed from. If not set, 'collection' is used by default
	'options' => [
		... // Dropzone options
	]
	...
]
```

Example:

```
<?php

...
$this->crud->operation(['update'], function() {
	$this->crud->addField([
		'label' => 'Photos',
		'type' => 'dropzone_media',
		'view_namespace' => 'dropzone::fields',
		'name' => 'photos',
		'collection' => 'photos',
		'thumb_collection' => 'thumbs',
		'options' => [
			'thumbnailHeight' => 120,
			'thumbnailWidth' => 120,
			'maxFilesize' => 10,
			'addRemoveLinks' => true,
			'createImageThumbnails' => true,
		],
	]);
});

...
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email adrian@gaspertrix.com instead of using the issue tracker.

## Credits

- [Adrian Sacchi][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/gaspertrix
[link-contributors]: ../../contributors
