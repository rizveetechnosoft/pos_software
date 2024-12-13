<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImei extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_transaction_id',
        'product_id',
        'variation_id',
        'variation_location_detail_id',
        'imei_1',
        'imei_2',
        'is_sold',
        'transaction_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
