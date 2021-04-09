<?php

namespace App\Http\Controllers;

use App\Bizpost;
use App\Business;
use App\Http\Requests\BusinessFormRequest;
use App\Http\Resources\BusinessResource;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Str;

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
     * Get slug for businessName
     *
     * @param $businessName
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSlug($businessName)
    {
        try {
            $slug = SlugService::createSlug(Bizpost::class, 'slug', $businessName);

            return response()->json([
                'slug' => $slug
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Πρόβλημα στην δημιουργία του slug'
            ], 204);
        }
    }

    /**
     * Store new business
     *
     * @param BusinessFormRequest $request
     * @return BusinessResource|\Illuminate\Http\JsonResponse
     */
    public function store(BusinessFormRequest $request)
    {
        $validatedData = $request->validated();

        $input = $request->all();

        // Add more fields in request
        $input['valid_code'] = Str::random(20);
        $input['bizcategory_id'] = rand(0,2);
        $input['customer_id'] = Str::random(20);

        try {
            $business = Business::create($input);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Δεν μπορεί να δημιουργηθεί η εταιρεία'
            ], 403);
        }

        return new BusinessResource($business);
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
