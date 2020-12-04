<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessApiController extends Controller
{
    /**
     * Return a business
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
     * Post new business
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
     * Update a business
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
     * Delete a business
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
