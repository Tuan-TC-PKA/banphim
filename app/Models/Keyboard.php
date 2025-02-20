<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', // Thêm product_id vào fillable
        'layout',
        'case_material',
        'pcb_type',
        'manufacturer',
    ];

    // Quan hệ một-một nghịch đảo với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}