<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property int $event_category_id
 * @property string $date
 * @property string $time
 * @property string $description
 * @property string $location
 * @property string $observations
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EventCategory $eventCategory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereEventCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereObservations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Player[] $playersWhoAttended
 */
class Event extends Model
{
    protected $guarded = ['id'];

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function playersWhoAttended()
    {
        return $this->belongsToMany(Player::class, 'event_assistances');
    }

//    public function assistences()
//    {
//        EventAssistance::
//    }

    public function playerAttend(Player $player)
    {
        $assistance = EventAssistance::where('event_id', '=', $this->id)
            ->where('player_id', '=', $player->id)->first();

        return ($assistance != null);
    }
}
