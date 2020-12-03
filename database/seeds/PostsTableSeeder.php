<?php

use App\Category;
use App\Link;
use App\Photo;
use App\Post;
use App\Tag;
use App\Video;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    protected array $categories = [
        'politics', 'sports', 'music', 'shopping'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->getOutput()->progressStart();

//        Post::flushEventListeners();

        $categories = Category::factory()->count(5)
            ->create();

        Post::factory( )->count(50)
            ->create()
            ->each(function ($post) use ($categories) {

                Photo::factory()->count(rand(1,5))
                    ->create()
                    ->each(function ($photo) use ($post) {
                        $post->photos()->attach($photo->id);
                    });

                Link::factory()->count(rand(1,5))
                    ->create()
                    ->each(function ($link) use ($post) {
                        $post->links()->attach($link->id);
                    });

                Tag::factory()->count(rand(1,5))
                    ->create()
                    ->each(function ($tag) use ($post) {
                        $post->tags()->attach($tag->id);
                    });

                Video::factory()->count(rand(1,5))
                    ->create()
                    ->each(function ($video) use ($post) {
                        $post->videos()->attach($video->id);
                    });

                $post->categories()->attach($categories[rand(0,4)]);

                $this->command->getOutput()->progressAdvance();
            });

        $this->command->getOutput()->progressFinish();
    }
}
