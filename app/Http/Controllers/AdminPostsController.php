<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostFormRequest;
use App\Post;
use Auth;
use Carbon\Carbon;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);

        return view('admin/posts/index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user_id = Auth::id();
        $userApiToken = Auth::user()->api_token;
        $categories = Category::all();

        return view('admin.posts.create', compact(['user_id', 'userApiToken', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostFormRequest $request)
    {
        $validatedData = $request->validated();

        $input = $request->all();

        if ($file = $request->uploadFile) {
            if ($file->isValid()) {

                $imgName = time() . '.' . $file->extension();
                $path = Carbon::now()->month;

                $file->move('images/' . $path, $imgName);

                $photo = Photo::create(['path' => $path, 'filename' => $imgName, 'reference' => $request->photo_reference]);

                $input['photo_id'] = $photo->id;

                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

            } else {
                return 'problem';
            }
        }

        $post = Post::create($input);

        $post->tags()->attach($request->tags); // Insert tags relation with pivot table

        $post->categories()->attach($request->categories); // Insert categories relation with pivot table

        return redirect(route('posts.index'));
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
        $userApiToken = Auth::user()->api_token;
        $post = Post::findOrFail($id);

        return view ('admin/posts/edit', compact(['post', 'userApiToken']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PostFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $input = $request->all();

        $post = Post::findOrFail($id);

        if($file = $request->uploadFile) {
            if ($file->isValid()) {

                $imgName = time() . '.' . $file->extension();
                $path = Carbon::now()->month;

                $file->move('images/' . $path, $imgName);

                $photo = Photo::create(['path' => $path, 'filename' => $imgName, 'reference' => $request->photo_reference]);

                $input['photo_id'] = $photo->id;

                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

            } else {
                return 'problem';
            }
        } else {
            if($photo = Photo::find($post->photo_id)) {
                $photo->update(['reference' => $request->photo_reference]);
            }
        }

        $post->update($input);

        $post->tags()->sync($request->tags); // Sync tags relation with pivot table

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $post = Post::whereId($id);
        $post->delete();

        return redirect(route('posts.index'));
    }
}
