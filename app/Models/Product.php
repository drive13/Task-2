<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product',
        'code_product',
        'price',
        'stock',
    ];

    public function orderDetail()
    {
        return $this->belongsToMany(OrderDetails::class, 'product_id', 'id');
    }
}
