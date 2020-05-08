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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $links = Link::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin/links/index', compact(['links']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.links.create');
    }

    /**
     * Store a newly created resource in storage, from admin page
     *
     * @param LinkFormRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function adminStore(LinkFormRequest $request)
    {
        $validatedData = $request->validated();

        $input = $request->all();

        try {
            $link = Link::create($input);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Δεν μπορεί να δημιουργηθεί το link '
            ], 403);
        }

        return redirect(route('links.index'));
    }

    /**
     * Store a newly created resource in storage, for api call
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
                'message' => 'Δεν μπορεί να δημιουργηθεί το link '
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $link = Link::findOrFail($id);

        return view ('admin/links/edit', compact(['link']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LinkFormRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(LinkFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $link = Link::findOrFail($id);

        $link->update($request->all());

        return redirect(route('links.index'));
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
