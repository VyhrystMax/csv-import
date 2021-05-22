<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductsAttributes extends Model
{
    protected $table = 'products_attributes';

    protected $hidden = ['p_hash'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'p_hash', 'product_hash');
    }
}
