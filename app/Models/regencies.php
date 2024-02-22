<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class regencies extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'regencies';
    protected $timestamp = false;
}
