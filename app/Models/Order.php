<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
        'status',
        'address', // Đã thay đổi từ shipping_address và billing_address thành address
        'phone_number', // Thêm phone_number vào fillable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với OrderItem (nếu bạn muốn quản lý chi tiết sản phẩm trong đơn hàng)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}