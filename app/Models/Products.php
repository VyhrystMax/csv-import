<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends Model
{
    protected $table = 'products';

    protected $hidden = ['product_hash'];

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductsAttributes::class, 'p_hash', 'product_hash');
    }

    public static function getFieldsMap(): array
    {
        /** key => label array */
        return [
            'manufacturer' => 'Manufacturer',
            'model' => 'Model',
            'price' => 'Price',
            'description' => 'Description',
            'product_url' => 'Link',
        ];
    }

}
