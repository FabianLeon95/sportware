<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pass
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $passer_id
 * @property int $receiver_id
 * @property int $yards
 * @property int $status_id
 * @property int $special_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass wherePasserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass whereSpecialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass whereYards($value)
 * @mixin \Eloquent
 * @property int $touchdown
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pass whereTouchdown($value)
 */
class Pass extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
