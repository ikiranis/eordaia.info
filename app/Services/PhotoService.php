<?php
/**
 *
 * File: PhotoService.php
 *
 * Created by Yiannis Kiranis <rocean74@gmail.com>
 * http://www.apps4net.eu
 *
 * Date: 20/4/20
 * Time: 12:13 π.μ.
 *
 * Services for Photo controller
 *
 */

namespace App\Services;

use Carbon\Carbon;
use Exception;
use Image;
use Storage;
use Illuminate\Support\Facades\File;

class PhotoService
{
    protected $file;
    protected $fileName;
    protected $path;
    protected $storageDisk = 'public';

    public function __construct($file)
    {
        $this->file = $file;

        $this->fileName = time() . '.' . $this->file->extension();
        $this->path = Carbon::now()->month;
    }

    /**
     * Save file. Main method
     */
    public function save() {
        $this->saveOriginalFile();
        $this->createThumbnail();
        $this->createMediumImage();
    }

    /**
     * Save file to storage
     *
     * @return bool
     * @throws Exception
     */
    private function saveOriginalFile() {
        try {
            Storage::disk($this->storageDisk)
                ->put( $this->path . '/' . $this->fileName,  File::get($this->file));
        } catch (\Exception $e) {
            throw new Exception('Δεν μπορεί να αποθηκευτεί το αρχείο -> ' .  $e);
        }
    }

    /**
     * Create a thumbnail of the image
     *
     * @throws Exception
     */
    private function createThumbnail() {
        try {
            $thumbnail = Image::make($this->file->getRealpath());
            $thumbnail->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });;

            Storage::disk($this->storageDisk)
                ->put( $this->path . '/small_' . $this->fileName, $thumbnail->encode());
        } catch (\Exception $e) {
            throw new Exception('Δεν μπορεί να αποθηκευτεί το thumbnail -> ' .  $e);
        }
    }

    /**
     * Create a thumbnail of the image
     *
     * @throws Exception
     */
    private function createMediumImage() {
        try {
            $thumbnail = Image::make($this->file->getRealpath());
            $thumbnail->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            });;

            Storage::disk($this->storageDisk)
                ->put( $this->path . '/medium_' . $this->fileName, $thumbnail->encode());
        } catch (\Exception $e) {
            throw new Exception('Δεν μπορεί να αποθηκευτεί το medium αρχείο -> ' .  $e);
        }
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $storageDisk
     */
    public function setStorageDisk(string $storageDisk): void
    {
        $this->storageDisk = $storageDisk;
    }
}
