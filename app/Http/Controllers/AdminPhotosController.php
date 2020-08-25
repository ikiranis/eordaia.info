<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoFormRequest;
use App\Http\Resources\PhotoResource;
use App\Photo;
use App\Services\PhotoService;
use Illuminate\Http\Request;
use Storage;

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
            $photoService = New PhotoService($request->file, [config('app.SMALL_IMAGE'), config('app.MEDIUM_IMAGE')]);

            // Save file
            try {
                $sizesCreated = $photoService->save();
            } catch(\Exception $exception) {
                $this->returnError($request->is('api*'), $exception->getMessage());
            }
        }

        // Save in database
        try {
            logger($sizesCreated[1]);
            $photo = Photo::create(
                [
                    'path' => isset($photoService) ? $photoService->getPath() : null,
                    'filename' => isset($photoService) ? $photoService->getFileName() : null,
                    'url' => $request->url ?? null,
                    'description' => $request->description,
                    'referral' => $request->referral,
                    'small' => $sizesCreated[0],
                    'medium' => $sizesCreated[1],
                    'viewable' => $request->viewable ?? false
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
            $photoService = New PhotoService($request->file, [config('app.SMALL_IMAGE'), config('app.MEDIUM_IMAGE')]);

            // Save file
            try {
                $photoService->save();
            } catch(\Exception $exception) {
                $this->returnError($request->is('api*'), $exception->getMessage());
            }

            $input = [
                'path' => isset($photoService) ? $photoService->getPath() : null,
                'filename' => isset($photoService) ? $photoService->getFileName() : null
            ];
        }

        $input['viewable'] = isset($request->viewable);

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
        $filePaths = [];
        $errors = [];

        $photo = Photo::whereId($id)->first();

        $filePaths[0] = '/' . $photo->path . '/' . $photo->filename;
        $filePaths[1] = '/' . $photo->path . '/' . config('app.SMALL_IMAGE') . 'x_' . $photo->filename;
        $filePaths[2] = '/' . $photo->path . '/' . config('app.MEDIUM_IMAGE') . 'x_' . $photo->filename;

        // Delete physical files
        foreach ($filePaths as $filePath) {
            if (Storage::disk('public')->exists($filePath)) {
                try {
                    Storage::disk('public')->delete($filePath);
                } catch (\Exception $e) {
                    array_push($errors,
                        'Υπήρξε πρόβλημα στη διαγραφή του αρχείου '
                        . $filePath . ' από τον δίσκο ' . $e->getMessage());
                }
            }
        }

        if (count($errors) > 0) {
            return response()->json([
                'message' => 'Υπήρξε πρόβλημα στη διαγραφή αρχείων από τον δίσκο',
                'debug' => $errors
            ], 400);
        }

        // Delete from database
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

    /**
     * Get the list pf photos for API call
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listPhotos()
    {
        $photos = Photo::orderBy('created_at', 'desc')
            ->get();

        return PhotoResource::collection($photos);
    }
}
