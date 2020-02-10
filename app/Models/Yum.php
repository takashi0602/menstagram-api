<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ヤム
 *
 * Class Yum
 * @package App\Models
 */
class Yum extends Model
{
    protected $fillable = [
        'user_id', 'slurp_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
