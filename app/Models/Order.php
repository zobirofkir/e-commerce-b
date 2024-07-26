<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "address",
        "city",
        "zip_code",
        "phone",
        "product_id"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
