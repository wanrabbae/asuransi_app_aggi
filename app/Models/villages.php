<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class villages extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'villages';
    protected $timestamp = false;
}
