<?php

namespace App\Http\Controllers;

use App;
use Carbon\Carbon;
use DB;
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
        $sitemap->add(URL::to('about'),  Carbon::now(), '0.8', 'daily');
        $sitemap->add(URL::to('contact'),  Carbon::now(), '0.8', 'daily');

        // get all posts from db
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();

        // add every post to the sitemap
        foreach ($posts as $post)
        {
            $sitemap->add(route('post', $post->slug), $post->updated_at, '1.0', 'daily');
        }

        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemaps/sitemap');
        // this will generate file mysitemap.xml to your public folder

        return view('admin.sitemap.created');
    }
}
