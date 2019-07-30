<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recovery
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $recover_id
 * @property int $yards
 * @property int $touch_down
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery whereRecoverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery whereTouchDown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery whereYards($value)
 * @mixin \Eloquent
 * @property int $touchdown
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recovery whereTouchdown($value)
 */
class Recovery extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
