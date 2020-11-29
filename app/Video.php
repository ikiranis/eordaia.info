<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
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
