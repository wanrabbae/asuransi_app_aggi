<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'artikels';    
     
   public function category()
   {
      return $this->belongsTo(CategoryArtikel::class, 'category_id', 'id');
   }
    
}
