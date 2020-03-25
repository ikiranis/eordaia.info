<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use Uuids;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'path',
        'filename',
        'reference'
    ];

    /**
     * Get the path with images folder
     *
     * @param $value
     * @return string
     */
//    public function getPathAttribute($value)
//    {
//        return '/images/' . $value;
//    }

    /**
     * Get full path/filename with images folder
     * Get it with $photo->fullPathName
     *
     * @return string
     */
    public function getFullPathNameAttribute()
    {
        return '/images/' . $this->path . '/' . $this->filename;
    }
}
