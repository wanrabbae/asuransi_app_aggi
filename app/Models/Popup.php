<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    protected $table = 'popups';
    protected $timestamp = false;
}
