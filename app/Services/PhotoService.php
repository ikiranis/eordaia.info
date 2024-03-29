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
use Debugbar;
use Exception;
use Image;
use phpDocumentor\Reflection\Types\Integer;
use Storage;
use Illuminate\Support\Facades\File;

class PhotoService
{
    protected object $file;
    protected string $fileName;
    protected string $path;
    protected string $storageDisk = 'public';
    protected array $sizes;
    protected array $sizesCreated = [];
    protected string $fileFormat = 'jpg';
    protected int $quality = 70;
    protected float $ratio;
    protected int $preloadImageQuality = 40;

    /**
     * PhotoService constructor.
     *
     * @param object $file
     * @param array $sizes
     * @param string $fileFormat
     */
    public function __construct(object $file, array $sizes, string $fileFormat)
    {
        $this->file = $file;
        $this->sizes = $sizes;
        $this->fileFormat = $fileFormat;

//        $this->fileName = time() . '.' . $this->file->extension();
        $this->fileName = time() . '.' .$this->fileFormat;
        $this->path = Carbon::now()->year . '/' . Carbon::now()->month;
    }

    /**
     * Save file. Main method
     *
     * @return array|\Illuminate\Support\Collection
     * @throws Exception
     */
    public function save()
    {
        $this->saveOriginalFile();

        foreach ($this->sizes as $size) {
            $this->createDifferentSizeImage($size);
        }

        return [
            'sizesCreated' => $this->sizesCreated,
            'ratio' => $this->ratio
        ];
    }

    /**
     * Save original file to storage
     *
     * @throws Exception
     */
    private function saveOriginalFile()
    {
        $image = Image::make($this->file->getRealpath());

        try {
            Storage::disk($this->storageDisk)
                ->put( $this->path . '/' . $this->fileName,  $image->encode($this->fileFormat, $this->quality));
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

        // BTW get ratio
        $this->ratio = $imageWidth / $imageHeight;

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
            array_push($this->sizesCreated, null);
            return;
        }

        try {
            $image = Image::make($this->file->getRealpath());
            $image->resize($size, $size, function ($constraint) {
                $constraint->aspectRatio();
            });;

            $quality = ($size == config('app.PRELOAD_IMAGE'))
                            ? $this->preloadImageQuality
                            : $this->quality;

            Storage::disk($this->storageDisk)
                ->put( $this->path . '/' . $size . 'x_' . $this->fileName,
                            $image->encode($this->fileFormat, $quality));

            array_push($this->sizesCreated, $size);
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
