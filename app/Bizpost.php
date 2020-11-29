<?php

namespace App;

use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
