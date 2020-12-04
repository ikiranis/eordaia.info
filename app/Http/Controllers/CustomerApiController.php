<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerApiController extends Controller
{
    /**
     * Return a customer
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
}
