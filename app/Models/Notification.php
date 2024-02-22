<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'notification';

    public function notif_detail()
    {
        return $this->hasOne(NotificationDetail::class, 'notification_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(OnlineTransaction::class, 'transaction_id');
    }
}
