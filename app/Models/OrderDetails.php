<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_order_id',
        'product_id',
        'qty',
        'total',
    ];

    public function invoice()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
