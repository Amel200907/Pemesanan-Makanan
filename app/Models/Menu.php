<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'category',
        'is_favorite',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'price' => 'decimal:2',
    ];
}
