<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * いいね
 *
 * Class Like
 * @package App\Models
 */
class Like extends Model
{
    protected $fillable = [
        'user_id', 'post_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
