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
        'referral',
        'medium',
        'small',
        'viewable',
        'large'
    ];

    /**
     * Get file path
     *
     * @return string
     */
    private function getFilePath(): string
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
    public function getPhotoUrlAttribute(): string
    {
        return ($this->filename)
            ? url($this->getFilePath() . $this->filename)
            : '';
    }

    /**
     * Get medium image full path name
     *
     * @return string
     */
    public function getMediumPhotoUrlAttribute(): string
    {
        if ($this->filename) {
            return ($this->medium)
                ? url($this->getFilePath() . $this->medium . 'x_' . $this->filename)
                : url($this->getFilePath() . $this->filename);
        }

        return '';
    }

    /**
     * Get small image full path name
     *
     * @return string
     */
    public function getSmallPhotoUrlAttribute(): string
    {
        if ($this->filename) {
            return ($this->small)
                ? url($this->getFilePath() . $this->small . 'x_' . $this->filename)
                : url($this->getFilePath() . $this->filename);
        }

        return '';
    }

    /**
     * Get large image full path name
     *
     * @return string
     */
    public function getLargePhotoUrlAttribute(): string
    {
        if ($this->filename) {
            return ($this->large)
                ? url($this->getFilePath() . $this->large . 'x_' . $this->filename)
                : url($this->getFilePath() . $this->filename);
        }

        return '';
    }

    /**
     * Get image for feed
     *
     * @return string
     */
    public function getFullFeedImageAttribute(): string
    {
        return url($this->mediumPhotoUrl);
    }

    /**
     * Get label for photo, if viewable is true
     *
     * @return string|null
     */
    public function getLabelAttribute(): ?string
    {
        return $this->viewable ? $this->description : null;
    }
}
