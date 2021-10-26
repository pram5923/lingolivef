<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'price', 'description'];
        function products(){
        return $this->belongsToMany(Product::class);
        }
}
