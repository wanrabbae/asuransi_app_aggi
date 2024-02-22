<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commission extends Model
{
    use HasFactory;

    protected $table = 'commissions';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'upline_id');
    }
    public function transaction()
    {
        return $this->belongsTo(OnlineTransaction::class, 'transaction_id');
    }
}
