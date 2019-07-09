<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Rookie
 *
 * @property int $id
 * @property int $user_id
 * @property int $position_id
 * @property string|null $observations
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Position $position
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie whereObservations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Rookie whereUserId($value)
 * @mixin \Eloquent
 */
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
