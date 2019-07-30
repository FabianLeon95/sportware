<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PassStatus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassStatus query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $status
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassStatus whereStatus($value)
 */
class PassStatus extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
}
