<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyboardSwitch extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', // Thêm product_id vào fillable
        'type',
        'manufacturer',
        'actuation_force',
        'bottom_out_force',
    ];

    // Quan hệ một-một nghịch đảo với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}