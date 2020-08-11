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
    protected object $file;
    protected string $fileName;
    protected string $path;
    protected string $storageDisk = 'public';
    protected array $sizes;

    /**
     * PhotoService constructor.
     *
     * @param object $file
     * @param array $sizes
     */
    public function __construct(object $file, array $sizes)
    {
        $this->file = $file;
        $this->sizes = $sizes;

        $this->fileName = time() . '.' . $this->file->extension();
        $this->path = Carbon::now()->month;
    }

    /**
     * Save file. Main method
     *
     * @throws Exception
     */
    public function save(): void
    {
        $this->saveOriginalFile();

        foreach ($this->sizes as $size) {
            $this->createDifferentSizeImage($size);
        }
    }

    /**
     * Save original file to storage
     *
     * @throws Exception
     */
    private function saveOriginalFile()
    {
        try {
            Storage::disk($this->storageDisk)
                ->put( $this->path . '/' . $this->fileName,  File::get($this->file));
        } catch (\Exception $e) {
            throw new Exception('Δεν μπορεί να αποθηκευτεί το αρχείο -> ' .  $e);
        }
    }

    /**
     * Check if some of the images dimensions is smaller than new size
     *
     * @param int $size
     * @return bool
     */
    private function checkIfOriginalPhotoIsSmaller(int $size): bool
    {
        $imageWidth = getimagesize($this->file)[0];
        $imageHeight = getimagesize($this->file)[1];

        $originalSize  = ($imageWidth >= $imageHeight)
                            ? $imageWidth
                            : $imageHeight;

        if ($originalSize <= $size) {
            return true;
        }

        return false;
    }

    /**
     * Create different size images
     *
     * @param int $size
     * @throws Exception
     */
    private function createDifferentSizeImage(int $size): void
    {
        // Stop if original photo is smaller than new size
        if ($this->checkIfOriginalPhotoIsSmaller($size)) {
            return;
        }

        try {
            $thumbnail = Image::make($this->file->getRealpath());
            $thumbnail->resize($size, $size, function ($constraint) {
                $constraint->aspectRatio();
            });;

            Storage::disk($this->storageDisk)
                ->put( $this->path . '/' . $size . 'x_' . $this->fileName, $thumbnail->encode());
        } catch (\Exception $e) {
            throw new Exception('Δεν μπορεί να δημιουργηθεί αρχείο άλλου μεγέθους -> ' .  $e);
        }
    }

    /**
     * @return mixed
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return mixed
     */
    public function getPath(): string
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
