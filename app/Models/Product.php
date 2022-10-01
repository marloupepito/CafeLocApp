<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    use HasFactory;
       protected $fillable = [
        'branchid',
        'price',
        'branchname',
        'rate',
        'productname',
        'about',
        'images',
        'menu'
    ];
     
}
