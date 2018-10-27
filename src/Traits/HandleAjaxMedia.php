<?php

namespace Gaspertrix\Backpack\DropzoneField\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

trait HandleAjaxMedia
{
    /**
     * Add file from the current request to the medialibrary
     *
     * @param  Request $request [description]
     * @param  int $id [description]
     * @return [type]           [description]
     */
    public function uploadMedia(Request $request, $id)
    {
        $entry = $this->crud->getEntry($id);
        $media = $entry->addMediaFromRequest('file')->toMediaCollection($request->input('collection'));

        return response()->json([
            'success' => true,
            'message' => 'Media successfully uploaded',
            'media' => $media,
        ]);
    }

    /**
     * Delete file from the medialibrary
     *
     * @param  Request $request [description]
     * @param  int $id [description]
     * @param  int $mediaId [description]
     * @return [type]           [description]
     */
    public function deleteMedia(Request $request, $id, $mediaId)
    {
        $media = Media::findOrFail($mediaId);
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media successfully deleted'
        ]);
    }

    /**
     * Delete file from the medialibrary
     *
     * @param  Request $request [description]
     * @param  int $id [description]
     * @return [type]           [description]
     */
    public function reorderMedia(Request $request, $id)
    {
        Media::setNewOrder($request->input('ids'));

        return response()->json([
            'success' => true
        ]);
    }
}
