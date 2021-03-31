<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Video
 *
 * @property string $id
 * @property string|null $name
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Bizpost[] $bizposts
 * @property-read int|null $bizposts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Database\Factories\VideoFactory factory(...$parameters)
 * @method static Builder|Video newModelQuery()
 * @method static Builder|Video newQuery()
 * @method static Builder|Video query()
 * @method static Builder|Video whereCreatedAt($value)
 * @method static Builder|Video whereId($value)
 * @method static Builder|Video whereName($value)
 * @method static Builder|Video whereUpdatedAt($value)
 * @method static Builder|Video whereUrl($value)
 * @mixin \Eloquent
 */
class Video extends Model
{
    use HasFactory;
    use Uuids;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = ['id', 'name', 'url'];

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
}
