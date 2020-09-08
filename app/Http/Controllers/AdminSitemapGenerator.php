<?php

namespace App\Http\Controllers;

use App;
use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use URL;

class AdminSitemapGenerator extends Controller
{
    public function index()
    {
        return view('admin.sitemap.sitemap');
    }

    public function run()
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('about'),  Carbon::now(), null, null);
        $sitemap->add(URL::to('contact'),  Carbon::now(), null, null);

        $categories = Category::all();

        // add every category to the sitemap
        foreach ($categories as $category)
        {
            $sitemap->add(route('category', $category->slug), Carbon::now(), null, null);
        }
        $tags = Tag::all();

        // add every tag to the sitemap
        foreach ($tags as $tag)
        {
            $sitemap->add(route('tag', $tag->slug), Carbon::now(), null, null);
        }

        // get all posts from db
        $posts = Post::orderBy('created_at', 'desc')->get();

        // add every post to the sitemap
        foreach ($posts as $post)
        {
            $sitemap->add(route('post', $post->slug), $post->updated_at, null, null);
        }



        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemaps/sitemap');
        // this will generate file mysitemap.xml to your public folder

        return view('admin.sitemap.created');
    }
}
