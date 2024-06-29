<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsTo;
=======
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a

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

<<<<<<< HEAD
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function pinfo(): BelongsTo{
        return $this->belongsTo(PInformation::class);
=======
    public function product(){

>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a
    }
}
