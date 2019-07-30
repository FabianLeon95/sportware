<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReportAttachment
 *
 * @property int $id
 * @property string $file_name
 * @property int $medical_report_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportAttachment whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportAttachment whereMedicalReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportAttachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReportAttachment extends Model
{
    protected $fillable = [
        'file_name', 'medical_report_id'
    ];

//    public function report()
//    {
//        return $this->belongsTo(User::class, 'id', 'patient_id');
//    }
}
