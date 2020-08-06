<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoFormRequest;
use App\Http\Resources\PhotoResource;
use App\Photo;
use App\Services\PhotoService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Mixed_;

class AdminPhotosController extends Controller
{
    /**
     * Return error, based on request kind (api or web)
     *
     * @param bool $requestKind
     * @param string $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function returnError(bool $requestKind, string $message)
    {
        if ($requestKind) {
            return response()->json([
                'message' => $message
            ], 204);
        }

        return redirect(route('photos.index'))
            ->withErrors([$message]);
    }

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

        if($request->file) {
            $photoService = New PhotoService($request->file, [150, 350]);

            // Save file
            try {
                $photoService->save();
            } catch(\Exception $exception) {
                $this->returnError($request->is('api*'), $exception->getMessage());
            }
        }

        // Save in database
        try {
            $photo = Photo::create(
                [
                    'path' => isset($photoService) ? $photoService->getPath() : null,
                    'filename' => isset($photoService) ? $photoService->getFileName() : null,
                    'url' => $request->url ?? null,
                    'description' => $request->description
                ]
            );
        } catch (\Exception $exception) {
            $this->returnError($request->is('api*'), $exception->getMessage());
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

        $input = $request->all();

        if($request->file) {
            $photoService = New PhotoService($request->file, [150, 350]);

            // Save file
            try {
                $photoService->save();
            } catch(\Exception $exception) {
                $this->returnError($request->is('api*'), $exception->getMessage());
            }

            $input = [
                'path' => isset($photoService) ? $photoService->getPath() : null,
                'filename' => isset($photoService) ? $photoService->getFileName() : null,
            ];
        }

        $photo = Photo::findOrFail($id);

        $photo->update($input);

        return redirect(route('photos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $photo = Photo::whereId($id);

        try {
            $photo->delete();
        } catch (\Exception $e) {
            $this->returnError($request->is('api*'), 'Δεν μπόρεσε να γίνει η διαγραφή: ' . $e->getMessage());
        }

        if ($request->is('api*')) {
            return response()->json([
                'message' => 'Η φωτογραφία διαγράφτηκε'
            ], 200);
        }

        return redirect(route('photos.index'));
    }
}
