<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhliWaris extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'ahli_waris';
    protected $timestamp = false;
}
