<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'barcode',
        'price',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function customers(): HasManyThrough{
        return $this->hasManyThrough(Customer::class, Order::class, 'product_id', 'id', 'id', 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function pinformations(): HasMany{
        return $this->hasMany(PInformation::class);
    }

    public function users(): HasManyThrough{
        return $this->hasManyThrough(User::class, Order::class, 'user_id', 'id', 'id', 'product_id',);
    }
}
