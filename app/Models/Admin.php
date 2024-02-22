<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Admin extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'admins';
    protected $timestamp = false;
}
