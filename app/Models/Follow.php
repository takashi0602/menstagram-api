<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * フォロー
 *
 * Class Follow
 * @package App\Models
 */
class Follow extends Model
{
    protected $fillable = ['user_id', 'target_user_id', ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
