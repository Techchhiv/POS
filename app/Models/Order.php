<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
<<<<<<< HEAD
    public function pinfo(): BelongsTo{
        return $this->belongsTo(PInformation::class);
    }
=======
>>>>>>> 5a3a02ee4411f2d88c5ee71db2a902940e95ec8a
}
