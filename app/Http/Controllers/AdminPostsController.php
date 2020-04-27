<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostFormRequest;
use App\Http\Resources\LinkResource;
use App\Http\Resources\PhotoResource;
use App\Http\Resources\VideoResource;
use App\Post;
use App\Services\PostService;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);

        return view('admin/posts/index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $user_id = Auth::id();
        $userApiToken = Auth::user()->api_token;
        $categories = Category::all();

        return view(
            'admin.posts.create',
            compact(['user_id', 'userApiToken', 'categories'])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostFormRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(PostFormRequest $request)
    {
        $validatedData = $request->validated();

        $input = $request->all();

        $post = Post::create($input);

        $post->tags()->attach($request->tags); // Insert tags relation with pivot table
        $post->categories()->attach($request->categories); // Insert categories relation with pivot table
        $post->photos()->attach($request->photos); // Insert photos relation with pivot table
        $post->links()->attach($request->links); // Insert links relation with pivot table
        $post->videos()->attach($request->videos); // Insert videos relation with pivot table

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $userApiToken = Auth::user()->api_token;
        $post = Post::findOrFail($id);
        $tags = PostService::getTags($post);
        $categories = PostService::getCheckedCategories($post);
        $photos = PhotoResource::collection($post->photos()->get());
        $links = LinkResource::collection($post->links()->get());
        $videos = VideoResource::collection($post->videos()->get());

        return view(
            'admin/posts/edit',
            compact(['post', 'userApiToken', 'tags', 'categories', 'photos', 'links', 'videos'])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostFormRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(PostFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $input = $request->all();

        $post = Post::findOrFail($id);

        $post->update($input);

        $post->tags()->sync($request->tags); // Sync tags relation with pivot table
        $post->categories()->sync($request->categories); // Sync categories relation with pivot table
        $post->photos()->sync($request->photos); // Sync categories relation with pivot table
        $post->links()->sync($request->links); // Sync categories relation with pivot table
        $post->videos()->sync($request->videos); // Sync categories relation with pivot table

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $post = Post::whereId($id);
        $post->delete();

        return redirect(route('posts.index'));
    }
}
