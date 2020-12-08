<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicPageRoutesTest extends TestCase
{
    /**
     * Test for index page.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test for about page
     *
     * @return void
     */
    public function testAbout()
    {
        $response = $this->get('/about');

        $response->assertStatus(200)
            ->assertSee('είναι ένα site με πληροφορίες');
    }

    /**
     * Test for contact page
     *
     * @return void
     */
    public function testContact()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200)
            ->assertSee('Στείλτε μας ανακοινώσεις');
    }

    /**
     * Test for feed page
     *
     * @return void
     */
    public function testFeed()
    {
        $response = $this->get('/feed');

        $response->assertStatus(200)
            ->assertSee('feed xmlns');
    }

    /**
     * Test for post page
     *
     * @return void
     */
    public function testPostPage()
    {
        $post = Post::firstOrFail();

        $response = $this->get('/' . $post->slug);

        $response->assertStatus(200)
            ->assertSee($post->title);
    }

    /**
     * Test for category page
     *
     * @return void
     */
    public function testCategoryPage()
    {
        $category = Category::firstOrFail();

        $response = $this->get('/category/' . $category->slug);

        $response->assertStatus(200)
            ->assertSee($category->name);
    }

    /**
     * Test for tag page
     *
     * @return void
     */
    public function testTagPage()
    {
        $tag = Tag::firstOrFail();

        $response = $this->get('/tag/' . $tag->slug);

        $response->assertStatus(200)
            ->assertSee($tag->name);
    }

    /**
     * Test for search page
     *
     * @return void
     */
    public function testSearchPage()
    {
        $post = Post::firstOrFail();

        $response = $this->get('/search?search=' . $post->title);

        $response->assertStatus(200)
            ->assertSee($post->title);
    }

    /**
     * Test for month page
     *
     * @return void
     */
    public function testMonthPage()
    {
        $post = Post::orderBy('created_at', 'desc')->first();
        $year = Carbon::createFromTimeString($post->created_at)->year;
        $month = Carbon::createFromTimeString($post->created_at)->month;

        $response = $this->get('/month/' . $year . '/' . $month);

        $response->assertStatus(200)
            ->assertSee($post->title);
    }

    /**
     * Test for bizpost page
     *
     * @return void
     */
    public function testBizpostPage()
    {
        $response = $this->get('/bizpost');

        $response->assertStatus(200)
            ->assertSee('Δημοσίευση');
    }
}


