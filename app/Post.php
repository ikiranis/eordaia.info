<?php

namespace App;

use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Str;
use Spatie\Feed\FeedItem;
use Spatie\Feed\Feedable;

class Post extends Model implements Feedable
{
    use Sluggable;
    use Uuids;

    public $incrementing = false;

    // Need to add this, for eager loading to work
    // With this, the uuid used as string in queries. Otherwise, the uuid converted to number and queries
    // doesn't work for some uuid's
    protected $keyType = 'string';

    // The attributes that are mass assignable
    protected $fillable = [
        'slug',
        'user_id',
        'title',
        'body',
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
            ->author('eordaia.info');
    }

    /**
     * Method to return posts for RSS feed
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getFeedItems()
    {
        return self::whereApproved(1)
            ->orderBy('created_at', 'desc')
            ->limit(15)
            ->get();
    }

    /**
     * Get the RSS body text
     *
     * @return string
     */
    public function rssBody()
    {
        return "<div> <img src='{$this->photos->first()->fullFeedImage}' align='center'></div>
                <div><p>{$this->description}</p><p>[..]</p></div>";
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
     * Relation to tags
     */
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Relation to Categories
     */
    public function categories() {
        return $this->belongsToMany('App\Category');
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

    /**
     * Relation to users
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Get body in markdown format
     *
     * @return mixed
     */
    public function getMarkdownBodyAttribute() {
        return Markdown::convertToHtml($this->body);
    }

    /**
     * Get description in markdown format
     *
     * @return mixed
     */
    public function getDescriptionAttribute() {
        return Str::words(strip_tags(Markdown::convertToHtml($this->body)), 50, '');
    }
}
