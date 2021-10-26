<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'category_id','price', 'description'];

    function shops() 
    {
        return $this->belongsToMany(Shop::class);
        }

        function category() {
            return$this->belongsTo(Category::class);
        }
}
