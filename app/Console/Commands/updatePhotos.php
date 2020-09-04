<?php

namespace App\Console\Commands;

use App\Photo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class updatePhotos extends Command
{
    protected $signature = 'update:photos';

    protected $description = 'Update photos table with image ratio';

    protected $process;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $photos = Photo::whereRatio(null)->get();

        foreach ($photos as $photo) {
            $filePath = '/' . $photo->path . '/' . $photo->filename;

            $file = Storage::disk('public')->path($filePath);

            $imageWidth = getimagesize($file)[0];
            $imageHeight = getimagesize($file)[1];
            $ratio = $imageWidth / $imageHeight;

            $input = ['ratio' => $ratio];

            try {
                $photo->update($input);

                $this->line('Ratio for file ' . $file . ' updated with ' . $ratio);
            } catch(\Exception $exception) {
                $this->line($exception);
            }
        }

    }
}
