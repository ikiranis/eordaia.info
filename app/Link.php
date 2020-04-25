<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use Uuids;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'url'
    ];

    /**
     * Relation to posts
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
