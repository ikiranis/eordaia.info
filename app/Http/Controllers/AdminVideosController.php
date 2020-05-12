<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoFormRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\VideoResource;
use App\Video;
use Illuminate\Http\Request;

class AdminVideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $videos = Video::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin/videos/index', compact(['videos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return VideoResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(VideoFormRequest $request)
    {
        $validatedData = $request->validated();

        $input = $request->all();

        try {
            $video = Video::create($input);
        } catch (\Exception $e) {
            if($request->is('api*')) {
                return response()->json([
                    'message' => 'Δεν μπορεί να δημιουργηθεί το video'
                ], 403);
            }

            return redirect(route('videos.index'))
                ->withErrors(['Δεν μπορεί να δημιουργηθεί το video']);
        }

        if($request->is('api*')) {
            return new VideoResource($video);
        }

        return redirect(route('videos.index'));
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
        $video = Video::findOrFail($id);

        return view ('admin/videos/edit', compact(['video']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(VideoFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $video = Video::findOrFail($id);

        $video->update($request->all());

        return redirect(route('videos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $video = Video::whereId($id);

        try {
            $video->delete();
        } catch (\Exception $e) {
            return redirect(route('videos.index'))
                ->withErrors(['Δεν μπόρεσε να γίνει η διαγραφή: ' . $e->getMessage()]);
        }

        return redirect(route('videos.index'));
    }
}
