<?php

namespace Gaspertrix\Backpack\DropzoneField\App\Http\Controllers\Operations;

use Illuminate\Support\Facades\Route;
use Gaspertrix\Backpack\DropzoneField\Traits\HandleAjaxMedia;

trait MediaOperation
{
    use HandleAjaxMedia;

    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupMediaRoutes($segment, $routeName, $controller)
    {
        Route::post($segment.'/{id}/media', [
            'as'        => $routeName.'.uploadMedia',
            'uses'      => $controller.'@uploadMedia',
            'operation' => 'media',
        ]);

        Route::delete($segment.'/{id}/media/{mediaId}', [
            'as'        => $routeName.'.deleteMedia',
            'uses'      => $controller.'@deleteMedia',
            'operation' => 'media',
        ]);

        Route::post($segment.'/{id}/media/reorder', [
            'as'        => $routeName.'.reorderMedia',
            'uses'      => $controller.'@reorderMedia',
            'operation' => 'media',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupMediaDefaults()
    {
        
    }
}
