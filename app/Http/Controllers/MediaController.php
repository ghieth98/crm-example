<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadedFileRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UploadedFileRequest $request
     * @param $model
     * @param $id
     * @return RedirectResponse
     */
    public function store(UploadedFileRequest $request, $model, $id): RedirectResponse
    {
        $uploadedMedia = app('App\Models\\'.$model)::find($id);

        $uploadedMedia->addMedia($request->file)->toMediaCollection();

        return redirect()->route(strtolower($model).'s.edit', $id);
    }

    public function download(Media $mediaItem): Media
    {
        return $mediaItem;
   }

    public function destroy($model, $id, Media $mediaItem): RedirectResponse
    {
        $mediaItem->delete();

        return redirect()->route(strtolower($model).'s.edit', $id);
   }
}
