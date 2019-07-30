<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReturnPlay
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $touch_down
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay whereTouchDown($value)
 * @mixin \Eloquent
 * @property int $yards
 * @property int $touchdown
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay whereYards($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReturnPlay whereTouchdown($value)
 */
class ReturnPlay extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
