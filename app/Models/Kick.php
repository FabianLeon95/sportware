<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kick
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $kicker_id
 * @property int $yards
 * @property string $special_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick whereKickerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick whereSpecialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick whereYards($value)
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kick whereType($value)
 */
class Kick extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function kicker()
    {
        return $this->hasOne(Player::class, 'id', 'kicker_id');
    }
}
