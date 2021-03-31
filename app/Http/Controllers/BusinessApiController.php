<?php

namespace App\Http\Controllers;

use App\Business;
use App\Http\Resources\BusinessResource;
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
     * Check if email exist and return the business
     *
     * @param $email
     * @return BusinessResource|\Illuminate\Http\JsonResponse
     */
    public function checkBusiness($email)
    {
        try {
            $business = Business::whereEmail($email)->firstOrFail();

            return new BusinessResource($business);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Δεν υπάρχει εγγραφή με αυτό το email'
            ], 204);
        }
    }

    /**
     * Check if slug exist
     *
     * @param $slug
     * @return BusinessResource|\Illuminate\Http\JsonResponse
     */
    public function checkSlug($slug)
    {
        try {
            $business = Business::whereSlug($slug)->firstOrFail();

            return response()->json([
                'message' => 'Υπάρχει ήδη το slug αυτό'
            ], 204);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Δεν υπάρχει εγγραφή με αυτό το email'
            ], 204);
        }
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
