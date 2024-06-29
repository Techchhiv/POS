<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PInformation extends Model
{
    use HasFactory;

    protected $table = 'pinformations';
    protected $fillable = [
        'product_id',
        'pinfo_id',
        'size',
        'color',
        'quantity',
    ];

    function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
}
