<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Play
 *
 * @property int $id
 * @property int $match_id
 * @property string $down
 * @property int $to_go
 * @property int $ball_on
 * @property string $quarter
 * @property int $home_points
 * @property int $visit_points
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereBallOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereDown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereHomePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereQuarter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereToGo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereVisitPoints($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereUpdatedAt($value)
 * @property int $team_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereTeamId($value)
 * @property int $left_team_id
 * @property int $right_team_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereLeftTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Play whereRightTeamId($value)
 */
class Play extends Model
{
    protected $guarded = [];
    public $incrementing = false;
}
