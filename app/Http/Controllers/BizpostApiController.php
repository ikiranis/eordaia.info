<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BizpostApiController extends Controller
{

    /**
     * Return a bizpost
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json([
            'message' => 'ok'
        ], 200);
    }

    /**
     * Post new bizpost
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'ok'
        ], 200);
    }

    /**
     * Update a bizpost
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'ok'
        ], 200);
    }

    /**
     * Delete a bizpost
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return response()->json([
            'message' => 'ok'
        ], 200);
    }
}
