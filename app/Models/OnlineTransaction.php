<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'online_transactions';
    protected $timestamp = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasOne(OnlineProduct::class, 'id', 'product_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'transaction_id', 'id');
    }

    public function ahliwaris()
    {
        return $this->hasMany(AhliWaris::class, 'transaction_id', 'id');
    }
}
