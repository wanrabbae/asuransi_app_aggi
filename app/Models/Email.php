<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'emails';

    public function transaction()
    {
        return $this->belongsTo(OnlineTransaction::class, 'transaction_id');
    }
}
