<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'customer_id',
        'date',
        'total_payment',
    ];

    public function details()
    {
        return $this->hasMany(OrderDetails::class, 'sales_order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
