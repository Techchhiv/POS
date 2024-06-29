<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;

    protected $table = 'user_cart';
    protected $fillable = [
        'pinfo_id',
        'user_id',
        'product_id',
        'quantity',
        'total'
    ];

    public function product(){

    }
}
