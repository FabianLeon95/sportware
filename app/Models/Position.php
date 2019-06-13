<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Position
 *
 * @property int $id
 * @property string $position_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position wherePositionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Position extends Model
{
    //
}
