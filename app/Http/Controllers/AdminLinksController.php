<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkFormRequest;
use App\Http\Resources\LinkResource;
use App\Link;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LinkFormRequest $request
     * @return LinkResource|JsonResponse
     */
    public function store(LinkFormRequest $request)
    {
        $validatedData = $request->validated();

        $input = $request->all();

        try {
            $link = Link::create($input);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Δεν μπορεί να δημιουργηθεί το link ' . $e
            ], 403);
        }

        return new LinkResource($link);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
