<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tackle
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $solo_id
 * @property int $assist_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle whereAssistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle whereSoloId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle whereTeamId($value)
 * @mixin \Eloquent
 * @property int $tackler_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tackle whereTacklerId($value)
 */
class Tackle extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function tackler()
    {
        return $this->hasOne(Player::class, 'id', 'tackler_id');
    }

    public function assist()
    {
        return $this->hasOne(Player::class, 'id', 'assist_id');
    }
}
