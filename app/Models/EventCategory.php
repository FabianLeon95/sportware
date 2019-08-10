<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EventCategory
 *
 * @property int $id
 * @property string $category_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCategory whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $color
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCategory whereColor($value)
 */
class EventCategory extends Model
{
    protected $guarded = ['id'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
