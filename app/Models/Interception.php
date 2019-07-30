<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Interception
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $interceptor_id
 * @property int $yards
 * @property int $touchdown
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception whereInterceptorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception whereTouchdown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Interception whereYards($value)
 * @mixin \Eloquent
 */
class Interception extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
