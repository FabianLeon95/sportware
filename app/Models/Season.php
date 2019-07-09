<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Season
 *
 * @property int $id
 * @property int $year
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Season whereYear($value)
 * @mixin \Eloquent
 */
class Season extends Model
{
    protected $fillable = [
      'year', 'description'
    ];
}
