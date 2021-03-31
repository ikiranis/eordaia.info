<?php

namespace App;

use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Bizpost
 *
 * @property string $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property int $activated
 * @property int $validated
 * @property string $valid_code
 * @property int $kind
 * @property string|null $business_id
 * @property string $due_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Link[] $links
 * @property-read int|null $links_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Photo[] $photos
 * @property-read int|null $photos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Video[] $videos
 * @property-read int|null $videos_count
 * @method static \Database\Factories\BizpostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereValidCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost whereValidated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bizpost withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Bizpost extends Model
{
    use HasFactory;
    use Sluggable;
    use Uuids;

    public $incrementing = false;

    protected $keyType = 'string';

    // The attributes that are mass assignable
    protected $fillable = [
        'slug',
        'title',
        'body',
        'activated',
        'validated',
        'valid_code',
        'kind',
        'business_id',
        'due_date'
    ];

    /**
     * Return the sluggable configuration array for this model.
     * @source https://github.com/cviebrock/eloquent-sluggable
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source'    => 'title'
            ]
        ];
    }

    /**
     * Relation to businesses
     */
    public function business()
    {
        $this->belongsTo('App\Business');
    }

    /**
     * Relation to videos
     */
    public function videos() {
        return $this->belongsToMany('App\Video');
    }

    /**
     * Relation to photos
     */
    public function photos() {
        return $this->belongsToMany('App\Photo');
    }

    /**
     * Relation to links
     */
    public function links() {
        return $this->belongsToMany('App\Link');
    }
}
