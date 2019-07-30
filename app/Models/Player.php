<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Player
 *
 * @property int $id
 * @property int $user_id
 * @property int $position_id
 * @property int $shirt_number
 * @property string $joined_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Position $position
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereJoinedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereShirtNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereUserId($value)
 * @mixin \Eloquent
 * @property int $team_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereTeamId($value)
 * @property-read \App\Models\Team $team
 */
class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'position_id', 'team_id' , 'shirt_number', 'joined_at'
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

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
