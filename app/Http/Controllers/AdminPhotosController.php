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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin/photos/index', compact(['photos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.photos.create');
    }

    /**
     * Store a photo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PhotoResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PhotoFormRequest $request)
    {
        $validatedData = $request->validated();
        $photoService = null;

        if($request->file) {
            $file = $request->file;
            $photoService = New PhotoService($file, [150, 500]);

            // Save file
            try {
                $photoService->save();
            } catch(\Exception $exception) {
                return response()->json([
                    'message' => $exception
                ], 204);
            }
        }

        // Save in database
        try {
            $photo = Photo::create(
                [
                    'path' => $photoService ? $photoService->getPath() : null,
                    'filename' => $photoService ? $photoService->getFileName() : null,
                    'url' => $request->url ?? null,
                    'description' => $request->description
                ]
            );
        } catch (\Exception $exception) {
            if ($request->is('api*')) {
                return response()->json([
                    'message' => 'Είναι αδύνατη η εγγραφή στην βάση δεδομένων'
                ], 204);
            }

            return redirect(route('photos.index'))
                ->withErrors(['Είναι αδύνατη η εγγραφή στην βάση δεδομένων: ' . $exception->getMessage()]);
        }

        if ($request->is('api*')) {
            return new PhotoResource($photo);
        }

        return redirect(route('photos.index'));

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);

        return view ('admin/photos/edit', compact(['photo']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PhotoFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $photo = Photo::findOrFail($id);

        $photo->update($request->all());

        return redirect(route('photos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $photo = Photo::whereId($id);

        try {
            $photo->delete();
        } catch (\Exception $e) {
            return redirect(route('photos.index'))
                ->withErrors(['Δεν μπόρεσε να γίνει η διαγραφή: ' . $e->getMessage()]);
        }

        return redirect(route('photos.index'));
    }
}
