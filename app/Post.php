<?php

namespace App;

use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Table\TableExtension;
use Str;
use Spatie\Feed\FeedItem;
use Spatie\Feed\Feedable;

/**
 * App\Post
 *
 * @property string $id
 * @property string $slug
 * @property string|null $user_id
 * @property string $title
 * @property string $body
 * @property int $approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed|null $cover
 * @property-read mixed $description
 * @property-read mixed $markdown_body
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Link[] $links
 * @property-read int|null $links_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Photo[] $photos
 * @property-read int|null $photos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \App\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Video[] $videos
 * @property-read int|null $videos_count
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Post extends Model implements Feedable
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
        'slug',
        'user_id',
        'title',
        'body',
        'approved'
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
        return "<div> <img src='{$this->cover->fullFeedImage}'></div>
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
        // Obtain a pre-configured Environment with all the CommonMark parsers/renderers ready-to-go
        $environment = Environment::createCommonMarkEnvironment();
        // Add this extension
        $environment->addExtension(new TableExtension());
        // Instantiate the converter engine and start converting some Markdown!
        $converter = new CommonMarkConverter([], $environment);

        return $converter->convertToHtml($this->body);
    }

    /**
     * Get description in markdown format
     *
     * @return mixed
     */
    public function getDescriptionAttribute() {
        return Str::words(strip_tags(Markdown::convertToHtml($this->body)), 50, '');
    }

    /**
     * Get the cover image for post
     *
     * @return mixed|null
     */
    public function getCoverAttribute()
    {
        if ($this->image_id) {
            return $this->photos()
                ->where('id', $this->image_id)
                ->first();
        }

        if ($photo = $this->photos->first()) {
            return $photo;
        }

        return null;
    }
}
