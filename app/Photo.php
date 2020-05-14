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
        'description'
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
     * Relation to posts
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }

    /**
     * Get full path/filename with images folder
     * Get it with $photo->fullPathName
     *
     * @return string
     */
    public function getPhotoUrlAttribute() : ?string
    {
        if($this->filename == null) {
            return null;
        }

        return env('APP_URL', false) . '/uploads/' . $this->path . '/' . $this->filename;
    }

    public function getMediumPhotoUrlAttribute() : ?string
    {
        if($this->filename == null) {
            return null;
        }

        return env('APP_URL', false) . '/uploads/' . $this->path . '/500x_' . $this->filename;
    }

    public function getSmallPhotoUrlAttribute() : ?string
    {
        if($this->filename == null) {
            return null;
        }

        return env('APP_URL', false) . '/uploads/' . $this->path . '/150x_' . $this->filename;
    }
}
