<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'category',
        'image',
    ];

    // Quan hệ một-một với Keycap
    public function keycapDetail()
    {
        return $this->hasOne(Keycap::class);
    }

    // Quan hệ một-một với Keyboard
    public function keyboardDetail()
    {
        return $this->hasOne(Keyboard::class);
    }

    // Quan hệ một-một với KeyboardSwitch
    public function switchDetail()
    {
        return $this->hasOne(KeyboardSwitch::class);
    }
}