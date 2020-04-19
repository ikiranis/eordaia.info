<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoFormRequest;
use App\Http\Resources\PhotoResource;
use App\Photo;
use App\Services\PhotoService;
use Illuminate\Http\Request;

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
     * @return PhotoResource|\Illuminate\Http\JsonResponse
     */
    public function store(PhotoFormRequest $request)
    {
        $validatedData = $request->validated();

        $file = $request->file;
        $photoService = New PhotoService($file);

        // TODO refactor and return image string (maybe)
//        if (!$file->isValid()) {
//            return response()->json([
//                'message' => 'Το αρχείο δεν είναι έγκυρο'
//            ], 403);
//        }

        try {
            $photoService->saveFile();
        } catch(\Exception $exception) {
            return response()->json([
                'message' => $exception
            ], 403);
        }

        try {
            $photo = Photo::create(
                [
                    'path' => $photoService->getPath(),
                    'filename' => $photoService->getFileName(),
                    'reference' => $request->reference
                ]
            );
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Είναι αδύνατη η εγγραφή στην βάση δεδομένων'
            ], 403);
        }
//        $input['photo_id'] = $photo->id;

        // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

        return new PhotoResource($photo);
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
