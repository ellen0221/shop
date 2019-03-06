<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    protected $fillable = ['amount', 'price', 'rating', 'review', 'reviewed_at'];
    protected $dates = ['reviewed_at'];
    public $timestamps = false;

    public function product()
    {
        $this->belongsTo(Product::class);
    }

    public function productSku()
    {
        $this->belongsTo(ProductSku::class);
    }

    public function order()
    {
        $this->belongsTo(Order::class);
    }
}
