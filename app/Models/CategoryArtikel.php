<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryArtikel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'category_artikels';

    public function Artikel()
    {
        return $this->hasMany(Artikel::class);
    }
}
