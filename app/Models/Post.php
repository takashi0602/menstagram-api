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
    protected $fillable = [
        'user_id', 'text', 'images', 'liked',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
