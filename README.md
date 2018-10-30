# laravel-backpack-dropzone-field

Add Dropzone support for [Laravel Backpack](https://laravel-backpack.readme.io/docs).

## Requirements
- [Laravel Backpack](https://laravel-backpack.readme.io/docs)
	- [Installation](https://laravel-backpack.readme.io/v3.4/docs/install-on-laravel-56 "Installation")
	- [Getting Started](https://laravel-backpack.readme.io/v3.4/docs/1-welcome-6-min "Getting Started")
- [Spatie Laravel Medialibrary](https://docs.spatie.be/laravel-medialibrary/v7/)
	- [Installation & setup](https://docs.spatie.be/laravel-medialibrary/v7/installation-setup "Installation & setup")
	- [Basic usage - Preparing your model](https://docs.spatie.be/laravel-medialibrary/v7/basic-usage/preparing-your-model "Basic usage - Preparing your model")

## Limitations
Currently, you can only manage media while editing an entry.

## Install

### Via Composer

``` bash
composer require gaspertrix/laravel-backpack-dropzone-field
```

Publish assets:
``` bash
php artisan gaspertrix:backpack:dropzone:install
```

## Usage

### EntityCrudController

For simplicity add the `HandleAjaxMedia` trait to all EntityCrudController.

```php
<?php

...

use Gaspertrix\Backpack\DropzoneField\Traits\HandleAjaxMedia;

...

class EntityCrudController extends CrudController
{
    use HandleAjaxMedia;

	...
}

```

### Routes

In your routes file, you have to add additionals routes in your `CRUD::resource`.

 ```php
 <?php

...

CRUD::resource('entity', 'EntityCrudController')->with(function () {
    Route::match(['post'], 'entity/{id}/media', 'EntityCrudController@uploadMedia');
    Route::match(['delete'], 'entity/{id}/media/{mediaId}', 'EntityCrudController@deleteMedia');
    Route::match(['post'], 'entity/{id}/media/reorder', 'EntityCrudController@reorderMedia');
});

...
 ```

### Field


```
[
	...
	'type' => 'dropzone_media',
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

$this->crud->addField([
	'label' => 'Photos',
	'type' => 'dropzone_media',
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
], 'update');

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
