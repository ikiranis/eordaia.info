<?php

namespace App;

use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
