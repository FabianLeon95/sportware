<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MedicalReport
 *
 * @property int $id
 * @property int $medic_id
 * @property int $patient_id
 * @property string $visit_reason
 * @property string $diagnostic
 * @property string $treatment
 * @property string $observations
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport whereDiagnostic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport whereMedicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport whereObservations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport whereTreatment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MedicalReport whereVisitReason($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $medic
 * @property-read \App\Models\User $patient
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReportAttachment[] $attachments
 */
class MedicalReport extends Model
{
    protected $fillable = [
        'medic_id',
        'patient_id',
        'visit_reason',
        'diagnostic',
        'treatment',
        'observations'
    ];

    public function medic()
    {
        return $this->hasOne(User::class, 'id', 'medic_id');
    }

    public function patient()
    {
        return $this->hasOne(User::class, 'id', 'patient_id');
    }

    public function attachments()
    {
        return $this->hasMany(ReportAttachment::class, 'medical_report_id', 'id');
    }
}
