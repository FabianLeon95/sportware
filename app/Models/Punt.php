<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Punt
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $kicker_id
 * @property int $yards
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Punt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Punt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Punt query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Punt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Punt whereKickerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Punt whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Punt wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Punt whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Punt whereYards($value)
 * @mixin \Eloquent
 */
class Punt extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
