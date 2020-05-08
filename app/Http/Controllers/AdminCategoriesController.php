<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin/categories/index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage, from admin page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function adminStore(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $category = Category::create($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Δεν μπορεί να δημιουργηθεί η κατηγορία'
            ], 403);
        }

        return redirect(route('categories.index'));
    }

    /**
     * Store a newly created resource in storage, from api request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $category = Category::create($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Δεν μπορεί να δημιουργηθεί η κατηγορία'
            ], 403);
        }

        return new CategoryResource($category);
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
        $category = Category::findOrFail($id);

        return view ('admin/categories/edit', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($id);

        $category->update($request->all());

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $category = Category::whereId($id);

        try {
            $category->delete();
        } catch (\Exception $e) {
            return redirect(route('categories.index'))
                ->withErrors(['Δεν μπόρεσε να γίνει η διαγραφή: ' . $e->getMessage()]);
        }

        return redirect(route('categories.index'));
    }
}
