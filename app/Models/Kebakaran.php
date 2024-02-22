<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kebakaran extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'kebakaran';

    public function online_transaction()
    {
        return $this->belongsTo(OnlineTransaction::class, 'online_transactions_id');
    }
}
