<?php

namespace App;

use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;
    use Uuids;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'slug',
        'photo_id',
        'user_id',
        'title',
        'description',
        'body',
        'reference',
        'approved',
        'author'
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

    // RSS Feed settings and methods
    // @source https://github.com/spatie/laravel-feed

    /**
     * Fields for RSS feed
     *
     * @return $this|array|FeedItem
     */
    public function toFeedItem()
    {
        return FeedItem::create()
            ->id($this->slug)
            ->title($this->title)
            ->summary($this->rssBody())
            ->updated($this->created_at)
            ->link($this->rssLink())
            ->author('WMSports');
    }

    /**
     * Method to return posts for RSS feed
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getFeedItems()
    {
        return self::whereApproved(1)->orderBy('created_at', 'desc')->limit(15)->get();
    }

    /**
     * Get the RSS body text
     *
     * @return string
     */
    public function rssBody()
    {
        return "<p><strong>{$this->description}</strong></p>
            <img src='{$this->photo->full_path_name}' width='350' align='left'>
            <div>{$this->body}</div>";
    }

    /**
     * Get rss post link
     *
     * @return string
     */
    public function rssLink()
    {
        return '/' . $this->slug;
    }

    /**
     * Relation to teams
     */
    public function teams() {
        return $this->belongsToMany('App\Team')->withTimestamps();
    }

    /**
     * Relation to tags
     */
    public function tags() {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * Relation to photos
     */
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    /**
     * Relation to photos
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Relation to athletes
     */
    public function athlete() {
        return $this->belongsTo('App\Athlete');
    }

    /**
     * Relation to matches
     */
    public function match() {
        return $this->belongsTo('App\Match');
    }

    /**
     * Relation to sports
     */
    public function sport() {
        return $this->belongsTo('App\Sport');
    }

    /**
     * Relation to comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}