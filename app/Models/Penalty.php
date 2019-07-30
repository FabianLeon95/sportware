<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Penalty
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $foul_id
 * @property string $status_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Penalty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Penalty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Penalty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Penalty whereFoulId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Penalty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Penalty whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Penalty wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Penalty whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Penalty whereTeamId($value)
 * @mixin \Eloquent
 */
class Penalty extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
