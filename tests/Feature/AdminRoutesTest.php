<?php

namespace Tests\Feature;

use App\Category;
use App\Link;
use App\Photo;
use App\Post;
use App\User;
use App\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminRoutesTest extends TestCase
{
    protected static $user;
    protected static bool $setUpRun = false;

    /**
     * Setup actions
     */
    public function setUp() : void
    {
        parent::setUp();

        if (!static::$setUpRun) {
            static::$user = User::first();

            static::$setUpRun = true;
        }
    }

    /**
     * Test admin page
     *
     * @return void
     */
    public function testAdminPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin');

        $response->assertStatus(200)
            ->assertSee('Admin Page');
    }

    /**
     * Test admin users page
     *
     * @return void
     */
    public function testAdminUsersPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/users');

        $response->assertStatus(200)
            ->assertSee('Χρήστες');
    }

    /**
     * Test admin user create page
     *
     * @return void
     */
    public function testAdminUserCreatePage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/users/create');

        $response->assertStatus(200)
            ->assertSee('Εισαγωγή χρήστη');
    }

    /**
     * Test admin user create page
     *
     * @return void
     */
    public function testAdminUserEditPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/users/' . static::$user->id . '/edit');

        $response->assertStatus(200)
            ->assertSee('Ενημέρωση χρήστη');
    }

    /**
     * Test admin posts page
     *
     * @return void
     */
    public function testAdminPostsPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/posts');

        $response->assertStatus(200)
            ->assertSee('Δημοσιεύσεις');
    }

    /**
     * Test admin post create page
     *
     * @return void
     */
    public function testAdminPostCreatePage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/posts/create');

        $response->assertStatus(200)
            ->assertSee('Εισαγωγή δημοσίευσης');
    }

    /**
     * Test admin post edit page
     *
     * @return void
     */
    public function testAdminPostEditPage() : void
    {
        $post = Post::first();

        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/posts/' . $post->id . '/edit');

        $response->assertStatus(200)
            ->assertSee('Ενημέρωση δημοσίευσης');
    }

    /**
     * Test admin categories page
     *
     * @return void
     */
    public function testAdminCategoriesPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/categories');

        $response->assertStatus(200)
            ->assertSee('Κατηγορίες');
    }

    /**
     * Test admin category create page
     *
     * @return void
     */
    public function testAdminCategoryCreatePage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/categories/create');

        $response->assertStatus(200)
            ->assertSee('Εισαγωγή Κατηγορίας');
    }

    /**
     * Test admin category edit page
     *
     * @return void
     */
    public function testAdminCategoryEditPage() : void
    {
        $category = Category::first();

        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/categories/' . $category->id . '/edit');

        $response->assertStatus(200)
            ->assertSee('Ενημέρωση Κατηγορίας');
    }

    /**
     * Test admin links page
     *
     * @return void
     */
    public function testAdminLinksPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/links');

        $response->assertStatus(200)
            ->assertSee('Σύνδεσμοι');
    }

    /**
     * Test admin link edit page
     *
     * @return void
     */
    public function testAdminLinkEditPage() : void
    {
        $link = Link::first();

        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/links/' . $link->id . '/edit');

        $response->assertStatus(200)
            ->assertSee('Ενημέρωση Συνδέσμου');
    }

    /**
     * Test admin photos page
     *
     * @return void
     */
    public function testAdminPhotosPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/photos');

        $response->assertStatus(200)
            ->assertSee('Φωτογραφίες');
    }

    /**
     * Test admin photo create page
     *
     * @return void
     */
    public function testAdminPhotoCreatePage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/photos/create');

        $response->assertStatus(200)
            ->assertSee('Εισαγωγή Φωτογραφίας');
    }

    /**
     * Test admin category edit page
     *
     * @return void
     */
    public function testAdminPhotoEditPage() : void
    {
        $photo = Photo::first();

        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/photos/' . $photo->id . '/edit');

        $response->assertStatus(200)
            ->assertSee('Ενημέρωση Φωτογραφίας');
    }

    /**
     * Test admin videos page
     *
     * @return void
     */
    public function testAdminVideosPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/videos');

        $response->assertStatus(200)
            ->assertSee('Video');
    }

    /**
     * Test admin video create page
     *
     * @return void
     */
    public function testAdminVideoCreatePage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/videos/create');

        $response->assertStatus(200)
            ->assertSee('Εισαγωγή Video');
    }

    /**
     * Test admin video edit page
     *
     * @return void
     */
    public function testAdminVideoEditPage() : void
    {
        $video = Video::first();

        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/videos/' . $video->id . '/edit');

        $response->assertStatus(200)
            ->assertSee('Ενημέρωση Video');
    }

    /**
     * Test admin sitemap page
     *
     * @return void
     */
    public function testAdminSitemapPage() : void
    {
        $video = Video::first();

        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/sitemap');

        $response->assertStatus(200)
            ->assertSee('Create Sitemap');
    }

    /**
     * Test admin sitemap created page
     *
     * @return void
     */
    public function testAdminSitemapCreatedPage() : void
    {
        $video = Video::first();

        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/createSitemap');

        $response->assertStatus(200)
            ->assertSee('Sitemap created');
    }
}
