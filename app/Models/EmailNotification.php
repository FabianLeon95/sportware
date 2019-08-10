<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EmailNotification
 *
 * @property int $id
 * @property int $user_id
 * @property string $subject
 * @property string $body
 * @property string $recipients
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailNotification whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailNotification whereRecipients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailNotification whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailNotification whereUserId($value)
 * @mixin \Eloquent
 */
class EmailNotification extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
