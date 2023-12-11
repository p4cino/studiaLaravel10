<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable;

class Product extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
        'title',
        'body',
        'price',
        'amount',
        'image'
    ];
}