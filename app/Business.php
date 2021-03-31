<?php

namespace App;

use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Business
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $address
 * @property string $email
 * @property int $bizcategory_id
 * @property string $customer_id
 * @property string|null $photo_id
 * @property string $valid_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BusinessFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Business findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Business newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Business newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Business query()
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereBizcategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business whereValidCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Business withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Business extends Model
{
    use HasFactory;
    use Sluggable;
    use Uuids;

    public $incrementing = false;

    // Need to add this, for eager loading to work
    // With this, the uuid used as string in queries. Otherwise, the uuid converted to number and queries
    // doesn't work for some uuid's
    protected $keyType = 'string';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'slug',
        'address',
        'email',
        'bizcategory_id',
        'customer_id',
        'photo_id',
        'valid_code'
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
                'source'    => 'name'
            ]
        ];
    }

    /**
     * Relation to customers
     */
    public function business()
    {
        $this->belongsTo('App\Customer');
    }
}
