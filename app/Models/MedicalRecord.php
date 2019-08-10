<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MedicalRecord
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property float $weight
 * @property float $height
 * @property int $diabetes
 * @property int $hypertension
 * @property int $dyslipidemia
 * @property int $cancer
 * @property int $cardiovascular
 * @property int $neurological
 * @property int $bruises
 * @property int $fractures
 * @property int $muscle_injuries
 * @property int $tobacco
 * @property int $alcohol
 * @property string $other
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereAlcohol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereBruises($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereCancer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereCardiovascular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereDiabetes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereDyslipidemia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereFractures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereHypertension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereMuscleInjuries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereNeurological($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereTobacco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereWeight($value)
 * @property string|null $dyslipidemias
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalRecord whereDyslipidemias($value)
 */
class MedicalRecord extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function user()
    {
        $this->belongsTo(User::class);
    }

}
