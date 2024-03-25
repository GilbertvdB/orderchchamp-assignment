<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon2User extends Model
{
    use HasFactory;

    public $fillable  = [
        'coupon_id',
        'user_id',
        'amount',
    ];
}
