<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    protected $guarded = ['id'];
}
