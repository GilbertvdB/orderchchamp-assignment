<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'subtotal', 
        'shipping', 
        'coupon',
        'tax',
        'total',
        'customer_id',
    ];

    /**
     * Get the customer associated with the order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'user_id', 'id');
    }
    
}
