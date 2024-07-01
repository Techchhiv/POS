<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function pinfo(): BelongsTo{
        return $this->belongsTo(PInformation::class);
    }
}
