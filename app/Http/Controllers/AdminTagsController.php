<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagFormRequest;
use App\Http\Resources\TagResource;
use App\Tag;
use Illuminate\Http\Request;

class AdminTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get();

        return TagResource::collection($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store tag
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TagResource|\Illuminate\Http\JsonResponse
     */
    public function store(TagFormRequest $request)
    {
        $validatedData = $request->validated();

        $input = $request->all();

        if($findTag = Tag::whereName($input['name'])->first()) {
            return new TagResource($findTag);
        }

        try {
            $tag = Tag::create($input);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Δεν μπορεί να δημιουργηθεί το tag'
            ], 403);
        }

        return new TagResource($tag);
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
