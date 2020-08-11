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
        'description',
        'referral'
    ];

    /**
     * Get file path
     *
     * @return string
     */
    private function getFilePath() : string
    {
        return env('APP_URL', false) . '/uploads/' . $this->path . '/';
    }

    /**
     * Relation to posts
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }

    /**
     * Get original image full path name
     *
     * @return string
     */
    public function getPhotoUrlAttribute() : string
    {
        return ($this->filename)
            ? $this->getFilePath() . $this->filename
            : '';
    }

    /**
     * Get medium image full path name
     *
     * @return string
     */
    public function getMediumPhotoUrlAttribute() : string
    {
        return ($this->filename)
            ? $this->getFilePath() . config('app.MEDIUM_IMAGE') . 'x_' . $this->filename
            : '';
    }

    /**
     * Get small image full path name
     *
     * @return string
     */
    public function getSmallPhotoUrlAttribute() : string
    {
        return ($this->filename)
            ? $this->getFilePath() . config('app.SMALL_IMAGE') . 'x_' . $this->filename
            : '';
    }
}
