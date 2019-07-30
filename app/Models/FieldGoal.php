<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FieldGoal
 *
 * @property int $id
 * @property int $match_id
 * @property string $play_id
 * @property int $team_id
 * @property int $kicker_id
 * @property int $good
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FieldGoal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FieldGoal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FieldGoal query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FieldGoal whereGood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FieldGoal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FieldGoal whereKickerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FieldGoal whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FieldGoal wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FieldGoal whereTeamId($value)
 * @mixin \Eloquent
 */
class FieldGoal extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
