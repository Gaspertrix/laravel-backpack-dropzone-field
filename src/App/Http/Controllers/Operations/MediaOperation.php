<?php

namespace Gaspertrix\LaravelBackpackDropzoneField\App\Http\Controllers\Operations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait MediaOperation
{
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

        Route::delete($segment.'/{id}/media', [
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

    /**
     * Add file from the current request to the medialibrary.
     *
     * @param Request $request [description]
     * @param int     $id      [description]
     *
     * @return [type] [description]
     */
    public function uploadMedia(Request $request, $id)
    {
        $entry = $this->crud->getEntry($id);
        $media = $entry->addMediaFromRequest('file')->toMediaCollection($request->input('collection'));

        return response()->json([
            'success' => true,
            'message' => __('dropzone::messages.media_successfully_uploaded'),
            'media'   => $media,
        ]);
    }

    /**
     * Delete file from the medialibrary.
     *
     * @param Request $request [description]
     * @param int     $id      [description]
     *
     * @return [type] [description]
     */
    public function reorderMedia(Request $request, $id)
    {
        $mediaClass = config('medialibrary.media_model');
        $mediaClass::setNewOrder($request->input('ids'));

        return response()->json([
            'success' => true,
            'message' => __('dropzone::messages.media_successfully_reordered'),
        ]);
    }

    /**
     * Delete file from the medialibrary.
     *
     * @param Request $request [description]
     * @param int     $id      [description]
     *
     * @return [type] [description]
     */
    public function deleteMedia(Request $request, $id)
    {
        $mediaId = $request->input('media_id');
        $mediaClass = config('medialibrary.media_model');

        $media = $mediaClass::findOrFail($mediaId);
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => __('dropzone::messages.media_successfully_deleted'),
        ]);
    }
}
