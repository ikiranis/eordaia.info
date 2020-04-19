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
use Storage;
use Illuminate\Support\Facades\File;

class PhotoService
{
    protected $file;
    protected $fileName;
    protected $path;

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
            Storage::disk('local')->put('images/' . $this->path . '/' . $this->fileName,  File::get($this->file));
        } catch (\Exception $e) {
            throw new Exception('Δεν μπορεί να αποθηκευτεί το αρχείο' .  $e);
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
}
