<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Foul
 *
 * @property int $id
 * @property string $description
 * @property int $distance
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Foul newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Foul newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Foul query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Foul whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Foul whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Foul whereId($value)
 * @mixin \Eloquent
 */
class Foul extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
