<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rookie extends Model
{
    protected $fillable = [
        'user_id', 'position_id', 'observations'
    ];
    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
