<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Run
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $runner_id
 * @property int $yards
 * @property int $touchdown
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereRunnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereTouchdown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereYards($value)
 * @mixin \Eloquent
 */
class Run extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
