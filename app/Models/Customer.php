<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'avatar',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function products(): HasManyThrough{
        return $this->hasManyThrough(
            UserCart::class,
            Order::class,
            'customer_id', // Foreign key on the orders table
            'user_id', // Foreign key on the UserCart table
            'id', // Local key on the customers table
            'user_id' // Local key on the orders table
        )->distinct();
    }

    public function ordersP(): HasManyThrough{
        return $this->hasManyThrough(
            UserCart::class,
            Order::class,
            'user_id',
            'user_id',
            'user_id',
            'user_id'
        )->distinct();
    }

    public function product()
    {
        return $this->hasManyThrough(
            Product::class,
            UserCart::class,
            'user_id', // Foreign key on the usercarts table
            'id', // Foreign key on the products table
            'user_id', // Local key on the customers table
            'product_id' // Local key on the usercarts table
        )->distinct();
    }

    public function orders(): HasMany{
        return $this->hasMany(Order::class);
    }
}
