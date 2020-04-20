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
     * Save file in Storage
     *
     * @throws Exception
     */
    public function saveFile() {
        try {
            Storage::disk($this->storageDisk)
                ->put( $this->path . '/' . $this->fileName,  File::get($this->file));
            return true;
        } catch (\Exception $e) {
            throw new Exception('Δεν μπορεί να αποθηκευτεί το αρχείο -> ' .  $e);
        }
    }

    /**
     * Create a thumbnail of the image
     *
     * @throws Exception
     */
    public function createThumbnail() {
        try {
            $thumbnail = Image::make($this->file->getRealpath());
            $thumbnail->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });;

            Storage::disk($this->storageDisk)
                ->put( $this->path . '/small_' . $this->fileName, $thumbnail->encode());

            return true;
        } catch (\Exception $e) {
            throw new Exception('Δεν μπορεί να αποθηκευτεί το thumbnail -> ' .  $e);
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
