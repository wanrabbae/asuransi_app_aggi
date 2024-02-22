<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'notification_detail';

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }
}
