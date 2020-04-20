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

    /**
     * PhotoService constructor.
     *
     * @param object $file
     */
    public function __construct(object $file)
    {
        $this->file = $file;

        $this->fileName = time() . '.' . $this->file->extension();
        $this->path = Carbon::now()->month;
    }

    /**
     * Save file. Main method
     *
     * @throws Exception
     */
    public function save(): void {
        $this->saveOriginalFile();
        $this->createDifferentSizeImage(150, 'small');
        $this->createDifferentSizeImage(500, 'medium');
    }

    /**
     * Save original file to storage
     *
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
     * Create different size images
     *
     * @param int $size
     * @param string $name
     * @throws Exception
     */
    private function createDifferentSizeImage(int $size, string $name): void {
        // TODO first check for original file size. Don't create if original is smaller
        try {
            $thumbnail = Image::make($this->file->getRealpath());
            $thumbnail->resize($size, $size, function ($constraint) {
                $constraint->aspectRatio();
            });;

            Storage::disk($this->storageDisk)
                ->put( $this->path . '/' . $name . '_' . $this->fileName, $thumbnail->encode());
        } catch (\Exception $e) {
            throw new Exception('Δεν μπορεί να δημιουργηθεί αρχείο άλλου μεγέυθους -> ' .  $e);
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
