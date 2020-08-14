<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Debugbar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the home page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::whereApproved( true)
            ->orderBy('created_at', 'desc')
            ->with('photos')
            ->simplePaginate(5);

        return view('public.home', compact(['posts']));
    }

    /**
     * Show post page
     *
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post($slug)
    {
        $post = Post::whereSlug($slug)
            ->whereApproved(true)
            ->with(['links', 'tags', 'photos', 'categories', 'videos'])
            ->firstOrFail();

        return view('public.post', compact('post'));
    }

    /**
     * Search posts
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::whereApproved(true)
            ->where(function($query) use ($search) {
                $query->where('body', 'LIKE', "%$search%")
                    ->orWhere('title', 'LIKE', "%$search%");
            })
            ->orderBy('updated_at', 'desc')
            ->simplePaginate(5);

        // Append search text for next pages
        $posts->appends(['search' => $search]);

        return view('public.search', compact(['search', 'posts']));
    }

    /**
     * Tag posts
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag($slug)
    {
        $tag = Tag::whereSlug($slug)->firstOrFail();

        $posts = $tag->posts()->with('photos')
            ->where('approved', true)
            ->orderBy('updated_at', 'desc')
            ->simplePaginate(5);

        return view('public.tagPosts', compact(['tag', 'posts']));
    }

    /**
     * Category posts
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();

        $posts = $category->posts()->with('photos')
            ->where('approved', true)
            ->orderBy('updated_at', 'desc')
            ->simplePaginate(5);

        return view('public.categoryPosts', compact(['category', 'posts']));
    }
}
