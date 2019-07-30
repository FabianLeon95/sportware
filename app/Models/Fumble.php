<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fumble
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $caused_by_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fumble newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fumble newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fumble query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fumble whereCausedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fumble whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fumble whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fumble wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fumble whereTeamId($value)
 * @mixin \Eloquent
 */
class Fumble extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
