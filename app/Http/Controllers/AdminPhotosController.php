<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoResource;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Storage;

class AdminPhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a photo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PhotoResource
     */
    public function store(Request $request)
    {
        // TODO refactor and return image string (maybe)
        if ($file = $request->file) {
            if ($file->isValid()) {

                $imgName = time() . '.' . $file->extension();
                $path = Carbon::now()->month;

                Storage::disk('local')->put('images/' . $path . '/' . $imgName,  File::get($file));

                $photo = Photo::create(['path' => $path, 'filename' => $imgName, 'reference' => $request->reference]);

                $input['photo_id'] = $photo->id;

                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

                return new PhotoResource($photo);
            } else {
                return 'problem';
            }
        } else {
//            if ($photo = Photo::find($post->photo_id)) {
//                $photo->update(['reference' => $request->photo_reference]);
//            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
