<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 投稿
 *
 * Class Post
 * @package App\Models
 */
class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'text', 'images', 'liked',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function limitedLikes()
    {
        return $this->hasMany(Like::class)->orderBy('id', 'desc')->limit(5);
    }

    /**
     * @param $value
     * @return array
     */
    public function getImagesAttribute($value)
    {
        return collect(json_decode($value))->map(function ($v, $k) {
            return config('app.url') . $v;
        })->all();
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getCreatedAtAttribute($value)
    {
        return str_replace('-', '/', $value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getUpdatedAtAttribute($value)
    {
        return str_replace('-', '/', $value);
    }
}
