<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{

    protected $fillable = [
    'code', 'buyer_id', 'store_id', 'address', 'address_id', 'city',
    'postal_code', 'shipping', 'shipping_type', 'shipping_cost',
    'tracking_number', 'tax', 'grand_total', 'payment_status',
    'status', 'shipping_receipt',
];

    protected $casts = [
        'subtotal' => 'decimal:2',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
