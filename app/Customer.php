<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Customer
 *
 * @property string $id
 * @property int $posts
 * @property int $payment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CustomerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    use HasFactory;
    use Uuids;

    public $incrementing = false;

    // Need to add this, for eager loading to work
    // With this, the uuid used as string in queries. Otherwise, the uuid converted to number and queries
    // doesn't work for some uuid's
    protected $keyType = 'string';

    // The attributes that are mass assignable
    protected $fillable = [
        'posts'
    ];
}
