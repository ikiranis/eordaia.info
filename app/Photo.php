<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Photo
 *
 * @property string $id
 * @property string|null $path
 * @property string|null $filename
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $referral
 * @property int|null $medium
 * @property int|null $small
 * @property int $viewable
 * @property int|null $large
 * @property int|null $preload
 * @property float|null $ratio
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Bizpost[] $bizposts
 * @property-read int|null $bizposts_count
 * @property-read string $full_feed_image
 * @property-read string|null $label
 * @property-read string $large_photo_url
 * @property-read string $medium_photo_url
 * @property-read string $photo_url
 * @property-read string $preload_url
 * @property-read string $small_photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Database\Factories\PhotoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereLarge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereMedium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo wherePreload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereReferral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereViewable($value)
 * @mixin \Eloquent
 */
class Photo extends Model
{
    use HasFactory;
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
        'large',
        'preload',
        'ratio'
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
     * Relation to bizposts
     */
    public function bizposts()
    {
        return $this->belongsToMany('App\Bizpost')->withTimestamps();
    }

    /**
     * Get original image full path name
     *
     * @return string
     */
    public function getPhotoUrlAttribute(): string
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
    public function getMediumPhotoUrlAttribute(): string
    {
        if ($this->filename) {
            return ($this->medium)
                ? $this->getFilePath() . $this->medium . 'x_' . $this->filename
                : $this->getFilePath() . $this->filename;
        }

        return '';
    }

    /**
     * Get preload image full path name
     *
     * @return string
     */
    public function getPreloadUrlAttribute(): string
    {
        if ($this->filename) {
            return ($this->preload)
                ? $this->getFilePath() . $this->preload . 'x_' . $this->filename
                : $this->smallPhotoUrl;
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
                ? $this->getFilePath() . $this->small . 'x_' . $this->filename
                : $this->getFilePath() . $this->filename;
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
                ? $this->getFilePath() . $this->large . 'x_' . $this->filename
                : $this->getFilePath() . $this->filename;
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
