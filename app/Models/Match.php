<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Match
 *
 * @property int $id
 * @property int $season_id
 * @property int $home_team_id
 * @property int $visit_team_id
 * @property string $game_type
 * @property string $date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Match newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Match newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Match query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Match whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Match whereGameType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Match whereHomeTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Match whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Match whereSeasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Match whereVisitTeamId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Team $homeTeam
 * @property-read \App\Models\Team $visitTeam
 */
class Match extends Model
{
    protected $guarded = ['id'];

    public function homeTeam()
    {
        return $this->hasOne(Team::class, 'id', 'home_team_id');
    }

    public function visitTeam()
    {
        return $this->hasOne(Team::class, 'id', 'visit_team_id');
    }
}
