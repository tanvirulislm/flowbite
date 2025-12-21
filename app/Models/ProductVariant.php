<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * A product variant belongs to one product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * A product variant has many variation options.
     */
    public function options()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes');
    }
}
