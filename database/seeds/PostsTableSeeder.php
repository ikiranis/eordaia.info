<?php

use App\Link;
use App\Photo;
use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->getOutput()->progressStart();

//        Post::flushEventListeners();

        factory(Post::class, 50)
            ->create()
            ->each(function ($post) {

                factory(Photo::class, 3)
                    ->create()
                    ->each(function ($photo) use ($post) {
                        $post->photos()->attach($photo->id);
                    });

                factory(Link::class, 3)
                    ->create()
                    ->each(function ($link) use ($post) {
                        $post->links()->attach($link->id);
                    });

                $this->command->getOutput()->progressAdvance();
            });

        $this->command->getOutput()->progressFinish();
    }
}
