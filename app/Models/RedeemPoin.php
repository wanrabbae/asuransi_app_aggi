<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedeemPoin extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'redeem_poins';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
